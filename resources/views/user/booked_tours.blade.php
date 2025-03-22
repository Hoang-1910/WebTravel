@extends('user.layout')

@section('content_user')
<div class="m-3 mt-4 mb-5">
    <h2>Danh sách tour đã đặt</h2>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" id="active-bookings-tab" data-bs-toggle="tab" href="#active-bookings">Tour đang đặt</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="cancelled-bookings-tab" data-bs-toggle="tab" href="#cancelled-bookings">Tour đã hủy</a>
        </li>
    </ul>
    
    <div class="tab-content mt-3">
        <!-- Tour đang đặt -->
        <div class="tab-pane fade show active" id="active-bookings">
            <table class="table table-bordered text-center" style="white-space: nowrap;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên tour</th>
                        <th>Ngày khởi hành</th>
                        <th>Số người</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $index => $booking)
                        @if($booking->status != 'cancelled')
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="truncate-text text-start">{{ $booking->tour->name ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->departure_date)->format('d/m/Y') }}</td>
                            <td>{{ $booking->num_people }}</td>
                            <td>{{ number_format($booking->total_price, 0, ',', '.') }} VNĐ</td>
                            <td class="{{ $booking->status == 'confirmed' ? 'text-success' : 'text-warning' }}">
                                {{ $booking->status == 'confirmed' ? 'Đã xác nhận' : 'Chờ xử lý' }}
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm" onclick="showCancelModal({{ $booking->id }})">Hủy</button>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    
        <!-- Tour đã hủy -->
        <div class="tab-pane fade" id="cancelled-bookings">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên tour</th>
                        <th>Ngày khởi hành</th>
                        <th>Số người</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $index => $booking)
                        @if($booking->status == 'cancelled')
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="truncate-text text-start">{{ $booking->tour->name ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->departure_date)->format('d/m/Y') }}</td>
                            <td>{{ $booking->num_people }}</td>
                            <td>{{ number_format($booking->total_price, 0, ',', '.') }} VNĐ</td>
                            <td class="text-danger">Đã hủy</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
</div>
@endsection