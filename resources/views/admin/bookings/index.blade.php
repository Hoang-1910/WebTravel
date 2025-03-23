@extends('admin.layout')

@section('content_admin')
<div class="container mt-4">
    <h2>Danh sách đặt tour</h2>
    <table class="table table-bordered table-striped text-center" style="white-space: nowrap;">
        <thead>
            <tr>
                <th>#</th>
                <th>Người đặt</th>
                <th>Tên Tour</th>
                <th>Ngày xuất phát</th>
                <th>Số khách</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $key => $booking)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $booking->user->name }}</td>
                <td class="truncate-text text-start">{{ $booking->tour->name }}</td>
                <td>{{ $booking->departure_date }}</td>
                <td>{{ $booking->num_people }}</td>
                <td>
                    @if($booking->status == "pending")
                        <span class="badge bg-warning text-dark">Đang chờ xác nhận</span>
                    @elseif($booking->status == "confirmed")
                        <span class="badge bg-success">Đã xác nhận</span>
                    @else
                        <span class="badge bg-danger">Đã hủy</span>
                    @endif
                </td>
                <td>
                    @if($booking->status == "pending")
                        <form action="{{ route('admin.bookings.confirm', $booking->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">Xác nhận</button>
                        </form>    
                    @elseif($booking->status != "cancelled")
                        <form action="{{ route('admin.bookings.cancel', $booking->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger">Hủy</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
</div>
@endsection