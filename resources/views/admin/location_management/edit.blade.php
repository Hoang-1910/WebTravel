@extends('admin.layout')

@section('content_admin')
<div class="container mt-4">
    <h2>Cập Nhật Địa Điểm</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.locations.update', $location->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Tên Địa Điểm</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $location->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả (tuỳ chọn)</label>
            <textarea name="description" class="form-control">{{ old('description', $location->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật</button>
        <a href="{{ route('admin.locations.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
