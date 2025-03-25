@extends('user.layout')

@section('content_user')
<div class="container mt-3 mb-3">
    <h2>Kết quả tìm kiếm</h2>

    @if($tours->isEmpty())
        <div class="alert alert-warning">Không tìm thấy tour phù hợp.</div>
    @else
    <section class="tour-sale">
        <div class="container">
            <div class="tour-grid">
                @foreach($tours as $tour)
                    {{-- <div class="col-md-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $tour->image) }}" class="card-img-top" alt="{{ $tour->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $tour->name }}</h5>
                                <p class="card-text">Điểm đến: {{ $tour->location->name }}</p>
                                <p class="card-text">Số người tối đa: {{ $tour->max_people }}</p>
                                <p class="card-text">Giá: {{ number_format($tour->price, 0, ',', '.') }} VNĐ</p>
                                <a href="{{ route('user.detail_tour',  ['id' => $tour->id]) }}" class="btn btn-primary mt-0">Xem chi tiết</a>
                            </div>
                        </div>
                    </div> --}}

                    <div class="tour-card">
                        <div class="tour-thumb">
                            <img src="{{ asset('storage/' . $tour->image) }}" alt="{{ $tour->name }}">
                            <div class="tour-price">
                                <p class="mb-0"><strong>Giá:</strong> {{ number_format($tour->price, 0, ',', '.') }} VND</p>
                            </div>
                        </div>
                        <div class="tour-content">
                            <h3>{{ $tour->name }}</h3>
                            <div class="tour-info">
                                <span style="white-space:nowrap"><i class="far fa-clock"></i>{{ $tour->duration }} ngày</span>
                                <span style="white-space:nowrap"><i class="fas fa-map-marker-alt"></i>{{ $tour->departureLocation->name ?? 'Null' }}</span>
                                <span style="white-space:nowrap"><i class="fa-solid fa-plane-departure"></i>{{ $tour->location ? $tour->location->name : 'Không xác định'  }}</span>
                            </div>
                            <a href="{{ route('user.detail_tour',  ['id' => $tour->id]) }}" class="btn-secondary">Xem chi tiết</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>
@endsection
