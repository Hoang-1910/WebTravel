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
            <p><strong>Số người tối đa:</strong> {{ $tour->max_people }}</p>
            <p><strong>Trạng thái:</strong> 
                <span class="badge {{ $tour->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                    {{ $tour->status == 'active' ? 'Hoạt động' : 'Ngừng hoạt động' }}
                </span>
            </p>
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                    @if($tour->image)
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('storage/' . $tour->image) }}">
                        </div>
                    @else
                        <span>Chưa có ảnh</span>
                    @endif

                    @if ($tourImages->count() > 0)
                        @foreach ($tourImages as $image)
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('storage/' . $image->image) }}">
                            </div>
                        @endforeach
                    @else
                        <span>Chưa có ảnh</span>
                    @endif
                    
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
            </div>
            
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.tour_management.index') }}" class="btn btn-secondary">Quay lại</a>
            <a href="{{ route('admin.tour_management.edit', $tour->id) }}" class="btn btn-warning">Chỉnh sửa</a>
            <a href="{{ route('admin.schedules.index', $tour->id) }}">Xem lịch trình</a>
        </div>
    </div>
</div>
@endsection
