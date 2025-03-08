@extends('admin.layout')

@section('content_admin')
<div class="container mt-4">
    <h2>Danh sách đặt tour</h2>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Người đặt</th>
                <th>Tour</th>
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
                <td>{{ $booking->tour->name }}</td>
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
                    {{-- <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-info btn-sm">Xem chi tiết</a> --}}
                </td>
            </tr>
            @endforeach
</div>
@endsection