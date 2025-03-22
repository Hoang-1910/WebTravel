@extends('admin.layout')

@section('content_admin')
<div class="container mt-4">
    <h3>Sửa slider</h3>
    <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Ảnh hiện tại</label><br>
            <img src="{{ asset('storage/' . $slider->image) }}" alt="slider" width="150">
        </div>
        <div class="mb-3">
            <label class="form-label">Ảnh mới (nếu muốn đổi)</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control" value="{{ $slider->title }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tiêu đề phụ</label>
            <input type="text" name="subtitle" class="form-control" value="{{ $slider->subtitle }}">
        </div>
        <div class="form-check mb-3">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" {{ $slider->is_active ? 'checked' : '' }}>
            <label class="form-check-label">Sử dụng slider này</label>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection