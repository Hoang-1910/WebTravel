@extends('admin.layout')

@section('content_admin')
    <div class="container">
        <h2>Chỉnh Sửa Danh Mục</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.categories.update', ['category' => $category->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Tên Danh Mục</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mô tả (tuỳ chọn)</label>
                <textarea name="description" class="form-control">{{ $category->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Cập Nhật Danh Mục</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection