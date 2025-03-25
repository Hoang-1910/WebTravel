@extends('admin.layout')

@section('content_admin')
<div class="container mt-4">
    <h2>Thêm Địa Điểm Mới</h2>

    <form action="{{ route('admin.locations.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tên Địa Điểm</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả (tuỳ chọn)</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Thêm Địa Điểm</button>
        <a href="{{ route('admin.locations.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
