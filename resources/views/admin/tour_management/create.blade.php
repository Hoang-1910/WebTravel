@extends('admin.layout')

@section('content_admin')
<div class="container">
    <h2>Thêm Tour Mới</h2>
    <form action="{{ route('admin.tour_management.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tên Tour</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô Tả</label>
            <textarea class="form-control" name="description"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="number" class="form-control" name="price" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Số Ngày</label>
            <input type="number" class="form-control" name="duration" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Loại Tour</label>
            <select class="form-control" name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Địa Điểm</label>
            <select class="form-control" name="location_id" required>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Hình Ảnh</label>
            <input type="file" class="form-control" name="image">
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng Thái</label>
            <select class="form-control" name="status">
                <option value="active">Hoạt động</option>
                <option value="inactive">Không hoạt động</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Thêm Tour</button>
    </form>
</div>
@endsection
