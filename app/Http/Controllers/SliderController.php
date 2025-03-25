<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function GetSliders()
    {
        // Lấy tất cả slider đang hoạt động và sắp xếp theo id mới nhất
        $sliders = Slider::where('is_active', 1)->orderBy('id', 'desc')->get();

        // Truyền dữ liệu ra view user
        return view('user.homepage', compact('sliders'));
    }
    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $imagePath = $request->file('image')->store('sliders', 'public');

        Slider::create([
            'image' => $imagePath,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Thêm slider thành công!');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('sliders', 'public');
            $slider->image = $imagePath;
        }

        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->is_active = $request->has('is_active') ? 1 : 0;
        $slider->save();

        return redirect()->route('admin.sliders.index')->with('success', 'Cập nhật slider thành công!');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'Xóa slider thành công!');
    }

    public function toggleStatus($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->is_active = !$slider->is_active;
        $slider->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái slider thành công.');
    }

}

