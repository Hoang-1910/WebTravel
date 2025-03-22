<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Booking;
use App\Models\Tour;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            session(['admin' => $admin]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác.']);
    }

    // Hiển thị thống kê cho dashboard admin
    public function dashboard()
    {
        // Thống kê số tour đã đặt theo từng tháng (Đảm bảo đủ 12 tháng)
        $bookingsByMonth = Booking::selectRaw('MONTH(departure_date) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();
    
        // Thêm các tháng bị thiếu vào mảng
        $bookingsByMonth = $this->fillMissingMonths($bookingsByMonth);
    
        // Thống kê doanh số theo tháng (VNĐ)
        $revenueByMonth = Booking::selectRaw('MONTH(departure_date) as month, SUM(total_price) as revenue')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('revenue', 'month')
            ->toArray();
    
        // Thêm các tháng bị thiếu vào mảng
        $revenueByMonth = $this->fillMissingMonths($revenueByMonth);
    
        // Lấy top 5 tour được đặt nhiều nhất
        $topTours = Tour::withCount('bookings')
            ->orderByDesc('bookings_count')
            ->limit(5)
            ->get(['id', 'name', 'bookings_count']);
    
        return view('admin.dashboard', compact('bookingsByMonth', 'revenueByMonth', 'topTours'));
    }
    

/**
 * Hàm hỗ trợ để thêm tháng bị thiếu vào dữ liệu thống kê
 */
private function fillMissingMonths($data)
{
    $filledData = array_fill(1, 12, 0); // Mảng với đủ 12 tháng (1 -> 12)
    
    foreach ($data as $month => $value) {
        $filledData[$month] = $value;
    }

    return $filledData;
}

    public function logout()
    {
        Session::forget('admin');
        return redirect()->route('admin.login');
    }

    public function showTourManagement(){ 
        return view('admin.tour_management.index');
    }

}
