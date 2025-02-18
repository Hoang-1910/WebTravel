@extends('admin.layout')

@section('content_admin')
<div class="container mt-4">
    <h2 class="mb-4">Chi tiết Tour</h2>
    
    <div class="card">
        <div class="card-header">
            <h4>{{ $tour->name }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Mô tả:</strong> {{ $tour->description }}</p>
            <p><strong>Giá:</strong> {{ number_format($tour->price, 0, ',', '.') }} VND</p>
            <p><strong>Thời gian:</strong> {{ $tour->duration }} ngày</p>
            <p><strong>Danh mục:</strong> {{ $tour->category->name }}</p>
            <p><strong>Địa điểm:</strong> {{ $tour->location->name }}</p>
            <p><strong>Trạng thái:</strong> 
                <span class="badge {{ $tour->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                    {{ $tour->status == 'active' ? 'Hoạt động' : 'Ngừng hoạt động' }}
                </span>
            </p>
            
            @if($tour->image)
                <p><strong>Hình ảnh:</strong></p>
                <img src="{{ asset('storage/' . $tour->image) }}" >
            @else
                <span>Chưa có ảnh</span>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.tour_management.index') }}" class="btn btn-secondary">Quay lại</a>
            <a href="{{ route('admin.tour_management.edit', $tour->id) }}" class="btn btn-warning">Chỉnh sửa</a>
        </div>
    </div>
</div>
@endsection
