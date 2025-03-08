<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Tour;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
     // Hiển thị danh sách đặt tour
     public function index()
     {
         $bookings = Booking::with('user', 'tour')->orderBy('booking_date', 'desc')->get();
         return view('admin.bookings.index', compact('bookings'));
     }
 
     // Hiển thị form đặt tour cho một tour cụ thể
     public function showBookingForm($tourId)
     {
         $tour = Tour::with('location')->findOrFail($tourId);
         $user = Auth::user(); // Lấy thông tin khách hàng đã đăng nhập
 
         return view('user.booking_tour', compact('tour', 'user'));
     }
 
     public function store(Request $request, Tour $tour)
{
    // Kiểm tra người dùng đã đăng nhập chưa
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để đặt tour!');
    }

    $request->validate([
        'departure_location' => 'required|string|max:255',
        'departure_date' => 'required|date|after_or_equal:today',
        'num_people' => 'required|integer|min:1|max:' . $tour->max_people, // Kiểm tra max_people
    ]);

    $total_price = $tour->price * $request->num_people; // Tính tổng giá

    Booking::create([
        'user_id' => Auth::id(),
        'tour_id' => $tour->id,
        'departure_location' => $request->departure_location,
        'departure_date' => $request->departure_date,
        'num_people' => $request->num_people,
        'total_price' => $total_price,
        'status' => 'pending'
    ]);

    return redirect()->route('user.homepage')->with('success', 'Đặt tour thành công!');
}
 
     // Hiển thị form chỉnh sửa đặt tour
     public function edit(Booking $booking)
     {
         $users = User::all();
         $tours = Tour::all();
         return view('bookings.edit', compact('booking', 'users', 'tours'));
     }
 
     // Cập nhật trạng thái đặt tour
     public function updateStatus(Request $request, Booking $booking)
     {
         $request->validate([
             'status' => 'required|in:pending,confirmed,cancelled'
         ]);
 
         $booking->update([
             'status' => $request->status
         ]);
 
         return redirect()->route('bookings.index')->with('success', 'Cập nhật trạng thái thành công!');
     }
 
     // Xóa đặt tour
     public function destroy(Booking $booking)
     {
         $booking->delete();
         return redirect()->route('bookings.index')->with('success', 'Xóa đặt tour thành công!');
     }
}
