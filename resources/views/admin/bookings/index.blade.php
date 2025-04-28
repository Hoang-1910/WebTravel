    @extends('admin.layout')

    @section('content_admin')
        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-4">Danh sách đặt tour</h2>
                <form action="{{ route('admin.bookings.index') }}" method="GET" class=" mb-4">
                    <div>
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="">-- Lọc theo trạng thái --</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Đang chờ xác nhận</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                    </div>
                </form>
            </div>

            <table class="table table-bordered table-striped text-center mt-4" style="white-space: nowrap;">
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
                        <td>{{ \Carbon\Carbon::parse($booking->departure_date)->format('d/m/Y') }}</td>
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
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $bookings->withQueryString()->links('pagination::bootstrap-5') }}
            </div>

        </div>
    @endsection