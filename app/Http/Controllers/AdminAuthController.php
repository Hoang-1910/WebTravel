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
    public function dashboard(Request $request)
    {
        $selectedMonth = $request->input('month', now()->format('Y-m')); // Mặc định là tháng hiện tại

        // Thống kê số tour đã đặt theo từng tháng trong năm
        $bookingsByMonth = Booking::selectRaw('MONTH(departure_date) as month, COUNT(*) as total')
            ->whereYear('departure_date', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $bookingsByMonth = $this->fillMissingMonths($bookingsByMonth);

        // Thống kê doanh số theo tháng
        $revenueByMonth = Booking::selectRaw('MONTH(departure_date) as month, SUM(total_price) as revenue')
            ->whereYear('departure_date', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('revenue', 'month')
            ->toArray();

        $revenueByMonth = $this->fillMissingMonths($revenueByMonth);

        // Lấy top 5 tour được đặt nhiều nhất theo tháng đã chọn
        $monthCarbon = \Carbon\Carbon::parse($selectedMonth);
        $topTours = Booking::selectRaw('tour_id, COUNT(*) as total')
            ->whereMonth('departure_date', $monthCarbon->month)
            ->whereYear('departure_date', $monthCarbon->year)
            // ->where('status', 'confirmed')
            ->groupBy('tour_id')
            ->orderByDesc('total')
            ->with('tour')
            ->limit(5)
            ->get();

        $topTourNames = $topTours->pluck('tour.name')->toArray();
        $topTourBookings = $topTours->pluck('total')->toArray();

        return view('admin.dashboard', compact(
            'bookingsByMonth',
            'revenueByMonth',
            'topTourNames',
            'topTourBookings',
            'selectedMonth'
        ));
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
