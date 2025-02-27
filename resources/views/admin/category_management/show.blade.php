@extends('admin.layout')

@section('content_admin')
<h2>Chi tiết danh mục</h2>
<table class="table">
    <tr>
        <th>ID:</th>
        <td>{{ $category->id }}</td>
    </tr>
    <tr>
        <th>Tên danh mục:</th>
        <td>{{ $category->name }}</td>
    </tr>
    <tr>
        <th>Mô tả:</th>
        <td>{{ $category->description }}</td>
    </tr>
    <tr>
        <th>Ngày tạo:</th>
        <td>{{ $category->created_at }}</td>
    </tr>
    <tr>
        <th>Ngày cập nhật:</th>
        <td>{{ $category->updated_at }}</td>
    </tr>
</table>
<a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Quay lại</a>
<a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class="btn">Chỉnh sửa</a>
@endsection
