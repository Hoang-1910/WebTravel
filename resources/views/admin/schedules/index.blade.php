@extends('admin.layout')

@section('content_admin')
    <h2>Lịch trình cho tour: {{ $tour->name }}</h2>
    <a href="{{ route('admin.schedules.create', $tour->id) }}" class="btn btn-primary btn-add-schedule"
        data-tour-id="{{ $tour->id }}"
        data-duration="{{ $tour->duration }}"
        data-schedules="{{ $tour->schedules_count }}">Thêm lịch trình</a>
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
                    {{-- <td>{{ $schedule->activity }}</td> --}}
                    <td class="formatted-text">{!! nl2br(e($schedule->activity)) !!}</td>
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

    <style>
        .formatted-text {
    text-align: justify; /* Căn đều hai bên */
}

.formatted-text br {
    display: block;
    content: "";
    margin-top: 8px; /* Tạo khoảng cách giữa các đoạn */
}

.formatted-text p {
    text-indent: 20px; /* Thụt đầu dòng */
    margin: 0;
}

    </style>
    <!-- Thêm thư viện SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.querySelector(".btn-add-schedule").addEventListener("click", function (event) {
        let tourId = this.getAttribute("data-tour-id"); // Lấy ID tour
        let duration = parseInt(this.getAttribute("data-duration")); // Số ngày của tour
        let schedulesCount = parseInt(this.getAttribute("data-schedules")); // Số lịch trình đã có

        if (schedulesCount >= duration) {
            event.preventDefault(); // Ngăn chuyển trang
            Swal.fire({
                icon: "warning",
                title: "Lịch trình đầy đủ!",
                text: "Bạn đã tạo đủ số ngày theo lịch trình của tour.",
                confirmButtonText: "OK",
                confirmButtonColor: "#3085d6"
            });
        } else {
            window.location.href = `/admin/schedules/create/${tourId}`;
        }
    });
</script>
@endsection
