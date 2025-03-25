<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    //
    // Hiển thị danh sách địa điểm
    public function index()
    {
        $locations = Location::latest()->paginate(10);
        return view('admin.location_management.index', compact('locations'));
    }

    // Hiển thị form tạo địa điểm
    public function create()
    {
        return view('admin.location_management.create');
    }

    public function edit(Location $location)
    {
        return view('admin.location_management.edit', compact('location'));
    }


    // Xử lý lưu địa điểm vào database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:locations',
            'description' => 'nullable|string',
        ]);

        Location::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.locations.index')->with('success', 'Địa điểm đã được tạo thành công!');
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:locations,name,' . $location->id,
            'description' => 'nullable|string',
        ]);

        $location->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.locations.index')->with('success', 'Địa điểm đã được cập nhật thành công!');
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('admin.locations.index')->with('success', 'Địa điểm đã được xóa thành công!');
    }
    
    public function getLocations()
    {
        $locations = Location::all(); // Lấy tất cả dữ liệu từ bảng locations
        return view('welcome', compact('locations'));
    }
}
