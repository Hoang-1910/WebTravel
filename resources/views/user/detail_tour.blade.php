@extends('user.layout')

@section('content_user')
    <div class="container mt-3">
        <div class="row">
            <div id="carouselExample" class="carousel slide col-7" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @if($tour->image)
                        <div class="carousel-item active">
                            <img class="" src="{{ asset('storage/' . $tour->image) }}" style="object-fit: cover; width:100%; height:450px !important">
                        </div>
                    @endif
                    @foreach ($tourImages as $image)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <img class="" src="{{ asset('storage/' . $image->image) }}" style="object-fit: cover; width:100%; height:450px !important">
                        </div>
                    @endforeach
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
            <div class="col-4 m-0 p-2">
                <h3>{{ $tour->name }}</h3>
                <p>Giá: {{ number_format($tour->price) }} VNĐ</p>
                <p>Điểm đến: {{ $tour->location->name }}</p>
                <p>Thời gian: {{ $tour->duration }} ngày</p>
                <p>Số người tối đa: {{ $tour->max_people }}</p>
                <a class="btn btn-primary">Đặt Tour</a>
            </div>
            <div class="col-6 mt-2">
                <h3>Lịch trình</h3>
                <p>{{ $tour->description }}</p>
            </div>
        </div>
    </div>
@endsection