@extends('admin.layout')

@section('content_admin')
<div class="container mt-4">
    <h2 class="mb-4">Chỉnh sửa Tour</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.tour_management.update', $tour->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Tên Tour</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $tour->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="description" class="form-control">{{ old('description', $tour->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giá (VND)</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price', $tour->price) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Thời gian (ngày)</label>
                    <input type="number" name="duration" class="form-control" value="{{ old('duration', $tour->duration) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Danh mục</label>
                    <select name="category_id" class="form-control" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $tour->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Địa điểm</label>
                    <select name="location_id" class="form-control" required>
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}" {{ $tour->location_id == $location->id ? 'selected' : '' }}>
                                {{ $location->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $tour->status == 'active' ? 'selected' : '' }}>Hoạt động</option>
                        <option value="inactive" {{ $tour->status == 'inactive' ? 'selected' : '' }}>Ngừng hoạt động</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hình ảnh</label>
                    <input type="file" name="image" class="form-control" multiple>
                    @if ($tour->image)
                        <img src="{{ asset('storage/' . $tour->image) }}" alt="Ảnh tour" class="img-fluid mt-2" width="200">
                    @endif
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Cập nhật</button>
                    <a href="{{ route('admin.tour_management.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
