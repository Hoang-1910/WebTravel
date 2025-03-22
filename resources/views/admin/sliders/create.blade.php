@extends('admin.layout')

@section('content_admin')
<div class="container mt-4">
    <h3>Thêm slider mới</h3>
    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Ảnh slider</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tiêu đề phụ</label>
            <input type="text" name="subtitle" class="form-control">
        </div>
        <div class="form-check mb-3">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" checked>
            <label class="form-check-label">Sử dụng slider này</label>
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>
        <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection