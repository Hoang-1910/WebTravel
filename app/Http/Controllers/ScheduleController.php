<?php

namespace App\Http\Controllers;
use App\Models\Tour;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // Hiển thị danh sách lịch trình của một tour
    public function index($tourId)
    {
        $tour = Tour::with('schedules')->findOrFail($tourId);
        return view('admin.schedules.index', compact('tour'));
    }

    // Hiển thị form thêm lịch trình mới
    public function create($tourId)
    {
        $tour = Tour::findOrFail($tourId);
        return view('admin.schedules.create', compact('tour'));
    }

    // Lưu lịch trình mới vào database
    public function store(Request $request, $tourId)
    {
        $validated = $request->validate([
            'day_number' => 'required|integer|min:1',
            'activity' => 'required|string',
        ]);

        $tour = Tour::findOrFail($tourId);
        $tour->schedules()->create($validated);

        return redirect()->route('admin.schedules.index', $tourId)->with('success', 'Lịch trình đã được thêm!');
    }

    // Hiển thị form chỉnh sửa lịch trình
    public function edit($tourId, Schedule $schedule)
    {
        $tour = Tour::findOrFail($tourId);
        return view('admin.schedules.edit', compact('tour', 'schedule'));
    }

    // Cập nhật lịch trình
    public function update(Request $request, $tourId, Schedule $schedule)
    {
        $validated = $request->validate([
            'day_number' => 'required|integer|min:1',
            'activity' => 'required|string',
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
