@extends('admin.layout')

@section('content_admin')
    <div class="container">
        <h2>Thêm khách sạn mới</h2>
        <form action="{{ route('admin.hotels.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <h5 class="form-label">Tên khách sạn:</h5>
                <input class="form-control" type="text" name="name" required>
            </div>
    
            <div class="row mb-3">
                <div class="col-6">
                    <h5 class="form-label">Địa điểm:</h5>
                    <select class="form-select form-control" name="location_id" required>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <h5 class="form-label">Số sao</h5>
                    <input type="number" name="rating" class="form-control">
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a class="btn btn-secondary me-2" href="{{ route('admin.hotels.index') }}">Back to list</a>
                <button class="btn btn-primary" type="submit">Add Hotel</button>
            </div>
        </form>
    </div>
@endsection