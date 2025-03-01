<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Tour;
use App\Models\User;

use Illuminate\Http\Request;

class BookingController extends Controller
{
     // Hiển thị danh sách đặt tour
     public function index()
     {
         $bookings = Booking::with('user', 'tour')->orderBy('booking_date', 'desc')->get();
         return view('bookings.index', compact('bookings'));
     }
 
     // Hiển thị form đặt tour mới
     public function create()
     {
         $users = User::all();
         $tours = Tour::all();
         return view('bookings.create', compact('users', 'tours'));
     }
 
     // Lưu đặt tour vào database
     public function store(Request $request)
     {
         $request->validate([
             'user_id' => 'required|exists:users,id',
             'tour_id' => 'required|exists:tours,id',
             'travel_date' => 'required|date',
             'num_people' => 'required|integer|min:1',
             'total_price' => 'required|numeric|min:0',
         ]);
 
         Booking::create([
             'user_id' => $request->user_id,
             'tour_id' => $request->tour_id,
             'travel_date' => $request->travel_date,
             'num_people' => $request->num_people,
             'total_price' => $request->total_price,
             'status' => 'pending'
         ]);
 
         return redirect()->route('bookings.index')->with('success', 'Đặt tour thành công!');
     }
 
     // Hiển thị form chỉnh sửa đặt tour
     public function edit(Booking $booking)
     {
         $users = User::all();
         $tours = Tour::all();
         return view('bookings.edit', compact('booking', 'users', 'tours'));
     }
 
     // Cập nhật trạng thái đặt tour
     public function update(Request $request, Booking $booking)
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
