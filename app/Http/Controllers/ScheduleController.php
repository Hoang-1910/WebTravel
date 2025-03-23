<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\Hotel;

class ScheduleController extends Controller
{
    // Hiển thị danh sách lịch trình của một tour
    public function index($tourId)
    {
        $tour = Tour::with('schedules')->withCount('schedules')->findOrFail($tourId);
        return view('admin.schedules.index', compact('tour'));
    }


    // Hiển thị form thêm lịch trình mới
    public function create($tourId)
{
    $tour = Tour::with('schedules')->findOrFail($tourId);
    $existingDays = $tour->schedules->pluck('day_number')->toArray(); // Lấy danh sách ngày đã có
    $nextDay = 1;

    $hotels = Hotel::all(); // Lấy danh sách khách sạn

    // Tìm số ngày tiếp theo chưa được sử dụng
    for ($i = 1; $i <= $tour->duration; $i++) {
        if (!in_array($i, $existingDays)) {
            $nextDay = $i;
            break;
        }
    }

    return view('admin.schedules.create', compact('tour', 'nextDay', 'hotels'));
}


    // Lưu lịch trình mới vào database
    public function store(Request $request, $tourId)
    {
        $validated = $request->validate([
            'day_number' => 'required|integer|min:1',
            'activity' => 'required|string',
            'hotel_id' => 'required|exists:hotels,id',
        ]);

        $tour = Tour::findOrFail($tourId);
        $tour->schedules()->create($validated);

        return redirect()->route('admin.schedules.index', $tourId)->with('success', 'Lịch trình đã được thêm!');
    }

    // Hiển thị form chỉnh sửa lịch trình
    public function edit($tourId, Schedule $schedule)
    {
        $tour = Tour::findOrFail($tourId);
        $hotels = Hotel::all();
        return view('admin.schedules.edit', compact('tour', 'schedule', 'hotels'));
    }

    // Cập nhật lịch trình
    public function update(Request $request, $tourId, Schedule $schedule)
    {
        $validated = $request->validate([
            'day_number' => 'required|integer|min:1',
            'activity' => 'required|string',
            'hotel_id' => 'required|exists:hotels,id',
        ]);

        $schedule->update($validated);

        return redirect()->route('admin.schedules.index', $tourId)
            ->with('success', 'Lịch trình đã được cập nhật!');
    }

    // Xóa lịch trình
    public function destroy($tourId, Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index', $tourId)
            ->with('success', 'Lịch trình đã bị xóa!');
    }
}
