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
}
