<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    // Hiển thị danh sách danh mục
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.category_management.index', compact('categories'));
    }

    // Hiển thị form tạo danh mục
    public function create()
    {
        return view('admin.category_management.create');
    }

    // Xử lý lưu danh mục vào database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được tạo thành công!');
    }

    public function edit(Category $category)
    {
        return view('admin.category_management.edit', compact('category'));
    }

    /**
     * Cập nhật danh mục.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật danh mục thành công!');
    }

    /**
     * Xóa danh mục.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được xóa!');
    }
    public function show(Category $category)
    {
        return view('admin.category_management.show', compact('category'));
    }
}
