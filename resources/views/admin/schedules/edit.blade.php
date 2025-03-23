@extends('admin.layout')

@section('content_admin')
    <h2>Chỉnh sửa lịch trình - {{ $tour->name }}</h2>

    <form action="{{ route('admin.schedules.update', [$tour->id, $schedule->id]) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group mb-3">
            <h6 for="day_number" class="form-label">Ngày số:</h6>
            <input type="number" name="day_number" class="form-control" value="{{ $schedule->day_number }}" required>
        </div>
        <div class="form-group mb-3">
            <h6 for="activity" class="form-label">Hoạt động:</h6>
            <textarea name="activity" class="form-control" required style="min-height: 200px; overflow: hidden; resize: none;" oninput="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';">{{ $schedule->activity }}</textarea>
        </div>
        <div class="form-group mb-3">
            <label for="hotel_id" class="form-label">Khách sạn:</label>
            <select name="hotel_id" class="form-control" required>
                <option value="">-- Chọn khách sạn --</option>
                @foreach($hotels as $hotel)
                    <option value="{{ $hotel->id }}" {{ $schedule->hotel_id == $hotel->id ? 'selected' : '' }}>
                        {{ $hotel->name }} ({{ $hotel->location->name ?? '' }})
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
@endsection
