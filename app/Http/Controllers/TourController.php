<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Category;
use App\Models\Location;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::with(['category', 'location'])->get();
        return view('admin.tour_management.index', compact('tours'));
    }

    public function create()
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('admin.tour_management.create', compact('categories', 'locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'duration' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tours', 'public');
            $data['image'] = $imagePath;
        }

        Tour::create($data);

        return redirect()->route('admin.tour_management.index')->with('success', 'Tour đã được thêm!');
    }

    public function edit(Tour $tour)
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('admin.tour_management.edit', compact('tour', 'categories', 'locations'));
    }

    public function update(Request $request, Tour $tour)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'duration' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tours', 'public');
            $data['image'] = $imagePath;
        }

        $tour->update($data);

        return redirect()->route('admin.tour_management.index')->with('success', 'Tour đã được cập nhật!');
    }

    // Xem chi tiết tour
    public function show(Tour $tour)
    {
        return view('admin.tour_management.show', compact('tour'));
    }


    public function destroy(Tour $tour)
    {
        $tour->delete();
        return redirect()->route('admin.tour_management.index')->with('success', 'Tour đã bị xóa!');
    }
}
