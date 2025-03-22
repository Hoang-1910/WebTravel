@extends('user.layout')

@section('content_user')
    <div class="container">
        <div class="section-header">
            <h2>{{ $category->name }}</h2>
        </div>
        @if($tours->isEmpty()){
            <p>Không có tour nào thuộc danh mục này</p>
        }
        @else
            <div class="tour-grid">
                @foreach($tours as $tour)
                    <div class="tour-card">
                        <div class="tour-thumb">
                            <img src="{{ asset('storage/' . $tour->image) }}" alt="Tour du lịch Miền Bắc">
                            <div class="tour-price">
                                <span class="price">{{ number_format($tour->price, 0, ',', '.') }} VND</span>
                            </div>
                        </div>
                        <div class="tour-content">
                            <h3>{{ $tour->name }}</h3>
                            <div class="tour-info">
                                <span><i class="far fa-clock"></i> 6 ngày 5 đêm</span>
                                <span><i class="fas fa-map-marker-alt"></i> Hà Nội</span>
                            </div>
                            <div class="tour-meta">
                                <span><i class="far fa-calendar-alt"></i> 18/04/2025</span>
                            </div>
                            <a href="{{ route('user.detail_tour',  ['id' => $tour->id]) }}" class="btn-secondary">Xem chi tiết</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection