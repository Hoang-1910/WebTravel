@extends('user.layout')

@section('content_user')
    <div class="container mt-3">
        <div class="row">
            <div class="col-8">
                @if($tour->image)
                    <img class="d-block w-100" src="{{ asset('storage/' . $tour->image) }}" style="width: auto; height: auto; max-width: 100%;">
                @else
                    <span>Chưa có ảnh</span>
                @endif
            </div>
            <div class="col-4 card card-style m-0 p-2 shadow-xs">
                <h3>{{ $tour->name }}</h3>
                <p>Giá: {{ number_format($tour->price) }} VNĐ</p>
                <p>Điểm đến: {{ $tour->location->name }}</p>
                <p>Thời gian: {{ $tour->duration }} ngày</p>
                <a class="btn btn-primary">Đặt Tour</a>
            </div>
            <div class="col-12 mt-2">
                <h3>Lịch trình</h3>
                <p>{{ $tour->description }}</p>
            </div>
        </div>
    </div>
@endsection