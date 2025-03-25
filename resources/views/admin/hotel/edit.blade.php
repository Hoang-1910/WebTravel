@extends('admin.layout')

@section('content_admin')
    <div class="container">
        <h2>Cập nhật thông tin khách sạn</h2>
        <form action="{{ route('admin.hotels.update', $hotel->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <h5 class="form-label">Tên khách sạn:</h5>
                <input class="form-control" type="text" name="name" value="{{ $hotel->name }}" required>
            </div>
    
            <div class="row mb-3">
                <div class="col-6">
                    <h5 class="form-label">Địa điểm:</h5>
                    <select class="form-select form-control" name="location_id" required>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}" {{ $hotel->location_id == $location->id ? 'selected' : '' }}>
                                {{ $location->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 mb-3">
                    <h5 class="form-label">Số sao</h5>
                    <div class="star-rating">
                        @for($i = 5; $i >= 1; $i--)
                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ $hotel->rating == $i ? 'checked' : '' }}>
                            <label for="star{{ $i }}">&#9733;</label>
                        @endfor
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end">
                <a class="btn btn-secondary me-2 mt-0" href="{{ route('admin.hotels.index') }}">Quay lại danh sách</a>
                <button class="btn btn-primary" type="submit">Cập nhật</button>
            </div>
        </form>
    </div>

    <style>
        .star-rating {
            direction: rtl;
            display: inline-flex;
            gap: 5px;
        }
        .star-rating input {
            display: none;
        }
        .star-rating label {
            font-size: 30px;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
        }
        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #ffc107;
        }
        </style>
@endsection
