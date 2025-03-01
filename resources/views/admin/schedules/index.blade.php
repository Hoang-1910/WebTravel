@extends('admin.layout')

@section('content_admin')
    <h2>Lịch trình cho tour: {{ $tour->name }}</h2>
    <a href="{{ route('admin.schedules.create', $tour->id) }}" class="btn btn-primary">Thêm lịch trình</a>
    <table class="table mt-3 table-bordered">
        <thead>
            <tr>
                <th class="col-1">Ngày</th>
                <th class="col-9">Hoạt động</th>
                <th class="col-2">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tour->schedules as $schedule)
                <tr>
                    <td>Ngày {{ $schedule->day_number }}</td>
                    <td>{{ $schedule->activity }}</td>
                    <td>
                        <a href="{{ route('admin.schedules.edit', [$tour->id, $schedule->id]) }}" class="btn btn-warning">Chỉnh sửa</a>
                        <form action="{{ route('admin.schedules.destroy', [$tour->id, $schedule->id]) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
