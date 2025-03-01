@extends('admin.layout')

@section('content_admin')
    <h2>Thêm lịch trình cho tour: {{ $tour->name }}</h2>

    <form action="{{ route('admin.schedules.store', $tour->id) }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="day_number" class="form-label">Ngày số:</label>
            <input type="number" name="day_number" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="activity" class="form-label">Hoạt động:</label>
            <textarea name="activity" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
@endsection
