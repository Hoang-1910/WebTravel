<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Category;
use App\Models\Location;
use App\Models\TourImage;

use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::with(['category', 'location'])->get();
        return view('admin.tour_management.index', compact('tours'));
    }
    public function showDetail($tour, Category $category)
    {
        $tour = Tour::findOrFail($tour); // Tìm tour theo ID
        $categories = Category::where('id', $category->id)->get();
        $tourImages = $tour->images; // Lấy danh sách ảnh liên quan
        return view('user.detail_tour', compact('tour', 'categories', 'tourImages'));
    }
    public function create()
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('admin.tour_management.create', compact('categories', 'locations'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'duration' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'status' => 'required|in:active,inactive',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'max_people' => 'required|integer|min:1'
        ]);

        // Tạo tour mới
        $tour = Tour::create($validated);

        // Lưu ảnh đại diện nếu có
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('tours', 'public');
        }

        // Lưu ảnh phụ nếu có
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('tour_images', 'public');
                $tour->images()->create(['image' => $path]);
            }
        }
        return redirect()->route('admin.tour_management.index')->with('success', 'Tour đã được thêm!');
    }
    


    public function edit(Tour $tour)
    {
        $categories = Category::all();
        $locations = Location::all();
        // Lấy danh sách ảnh phụ
        $tourImages = $tour->images;
        return view('admin.tour_management.edit', compact('tour', 'categories', 'locations', 'tourImages'));
    }

    

    public function update(Request $request, Tour $tour){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required',
            'duration' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'status' => 'required|in:active,inactive',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'max_people' => 'required|integer|min:1'
        ]);

        $tour->update($validatedData);

        // Cập nhật ảnh đại diện nếu có
        if ($request->hasFile('image')) {
            if ($tour->image) {
                Storage::delete('public/' . $tour->image);
            }
            $path = $request->file('image')->store('tours', 'public');
            $tour->update(['image' => $path]);
        }

        // Nếu có ảnh phụ mới, thì xóa ảnh cũ trước khi thêm mới
        if ($request->hasFile('images')) {
            // Xóa ảnh phụ cũ trong Storage
            foreach ($tour->images as $oldImage) {
                if (Storage::exists('public/' . $oldImage->image)) {
                    Storage::delete('public/' . $oldImage->image);
                }
            }
            // Xóa dữ liệu ảnh phụ cũ trong database
            $tour->images()->delete();
            // Thêm ảnh phụ mới
            foreach ($request->file('images') as $image) {
                $path = $image->store('tour_images', 'public');
                $tour->images()->create(['image' => $path]);
            }
        }

        return redirect()->route('admin.tour_management.index')->with('success', 'Cập nhật tour thành công');
    }



    public function show($id)
    {
        $tour = Tour::with(['category', 'location'])->findOrFail($id);
        $tourImages = TourImage::where('tour_id', $id)->get(); // Lấy ảnh phụ

        return view('admin.tour_management.show', compact('tour', 'tourImages'));
    }



    public function destroy(Tour $tour)
    {
    // Xóa ảnh chính
    Storage::disk('public')->delete($tour->image);
    // Xóa ảnh phụ
    foreach ($tour->images as $image) {
        Storage::disk('public')->delete($image->image);
        $image->delete();
    }
    $tour->delete();
    return redirect()->route('tours.index')->with('success', 'Tour deleted successfully!');
    }

}
