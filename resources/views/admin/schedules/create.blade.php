@extends('admin.layout')

@section('content_admin')
    <h2>Thêm lịch trình cho tour: {{ $tour->name }}</h2>

    <form action="{{ route('admin.schedules.store', $tour->id) }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="day_number" class="form-label">Ngày số:</label>
            <input type="number" name="day_number" class="form-control" value="{{ $nextDay }}" max="{{ $tour->duration }}"  required>
        </div>
        <div class="form-group mb-3">
            <label for="activity" class="form-label">Hoạt động:</label>
            <textarea name="activity" class="form-control" required style="min-height: 100px; overflow: hidden; resize: none;" oninput="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="hotel_id" class="form-label">Khách sạn ở:</label>
            <select name="hotel_id" class="form-select" required>
                <option value="">-- Chọn khách sạn --</option>
                @foreach ($hotels as $hotel)
                    <option value="{{ $hotel->id }}">{{ $hotel->name }} ({{ $hotel->location->name }})</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
@endsection
