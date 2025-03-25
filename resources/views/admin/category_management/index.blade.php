@extends('admin.layout')

@section('content_admin')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2>Danh Sách Danh Mục</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3"><i class="fa-solid fa-plus pe-2"></i>Thêm Danh Mục Mới</a>
    </div>
    {{-- @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif --}}

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Danh Mục</th>
                <th>Mô Tả</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $index => $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <a href="{{ route('admin.categories.show', ['category' => $category->id]) }}" class="btn btn-secondary mt-0">Xem chi tiết</a>
                        <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categories->links() }}
</div>
@endsection
