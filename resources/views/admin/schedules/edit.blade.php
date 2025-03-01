@extends('admin.layout')

@section('content_admin')
    <h2>Chỉnh sửa lịch trình - {{ $tour->name }}</h2>

    <form action="{{ route('admin.schedules.update', [$tour->id, $schedule->id]) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label for="day_number">Ngày số:</label>
            <input type="number" name="day_number" class="form-control" value="{{ $schedule->day_number }}" required>
        </div>
        <div class="form-group">
            <label for="activity">Hoạt động:</label>
            <textarea name="activity" class="form-control" required>{{ $schedule->activity }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
@endsection
