@extends('user.layout')

@section('content_user')
<div class="container mt-3 mb-3">
    <h2>Kết quả tìm kiếm</h2>

    @if($tours->isEmpty())
        <div class="alert alert-warning">Không tìm thấy tour phù hợp.</div>
    @else
        <div class="row">
            @foreach($tours as $tour)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $tour->image) }}" class="card-img-top" alt="{{ $tour->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $tour->name }}</h5>
                            <p class="card-text">Điểm đến: {{ $tour->location->name }}</p>
                            <p class="card-text">Số người tối đa: {{ $tour->max_people }}</p>
                            <p class="card-text">Giá: {{ number_format($tour->price, 0, ',', '.') }} VNĐ</p>
                            <a href="{{ route('user.detail_tour',  ['id' => $tour->id]) }}" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
