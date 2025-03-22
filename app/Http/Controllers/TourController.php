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
        $tour = Tour::with(['images', 'schedules', 'departureLocation'])->findOrFail($tour); // Lấy tour + ảnh + lịch trình
        $categories = Category::findOrFail($category); // Lấy danh mục theo ID
        $tourImages = $tour->images; // Lấy danh sách ảnh liên quan
        $schedules = $tour->schedules; // Lấy lịch trình của tour
        return view('user.detail_tour', compact('tour', 'tourImages', 'categories', 'schedules'));
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
            'departure_location' => 'required|string|max:255',
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
            'departure_location' => 'required|string|max:255',
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
        $tour = Tour::with(['category', 'location', 'departureLocation'])->findOrFail($id);
        $tourImages = TourImage::where('tour_id', $id)->get(); // Lấy ảnh phụ

        return view('admin.tour_management.show', compact('tour', 'tourImages'));
    }

    public function showInUser($id){
        // Lấy thông tin tour theo ID
        $tour = Tour::with(['location', 'schedules', 'reviews', 'departureLocation'])->findOrFail($id);

        // Lấy hình ảnh liên quan đến tour
        $tourImages = TourImage::where('tour_id', $id)->get();

        // Trả về view chi tiết tour
        return view('user.detail_tour', compact('tour', 'tourImages')); 
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
        return redirect()->route('admin.tour_management.index')->with('success', 'Tour deleted successfully!');
    }

    public function search(Request $request)
{
    // Validate dữ liệu nhập vào
    $request->validate([
        'departure_location' => 'nullable|string|max:255',
        'destination' => 'nullable|exists:locations,id',
        'people' => 'nullable|integer|min:1',
    ]);

    // Lấy dữ liệu từ request
    $departureLocation = $request->departure_location;
    $destinationId = $request->destination;
    $people = $request->people;

    // Tạo query builder ban đầu
    $tours = Tour::query()->where('status', 'active');

    // Nếu có điểm xuất phát, thêm điều kiện
    if ($departureLocation) {
        $tours->where('departure_location', 'LIKE', "%{$departureLocation}%");
    }

    // Nếu có địa điểm đến, thêm điều kiện
    if ($destinationId) {
        $tours->where('location_id', $destinationId);
    }

    // Nếu có số lượng người, thêm điều kiện
    if ($people) {
        $tours->where('max_people', '>=', $people);
    }

    // Lấy kết quả và sắp xếp theo tour mới nhất
    $tours = $tours->orderBy('created_at', 'desc')->get();

    return view('user.search_results', compact('tours'));
}

    
}
