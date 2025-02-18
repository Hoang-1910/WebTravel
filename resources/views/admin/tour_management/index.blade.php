@extends('admin.layout')

@section('content_admin')
    <div class="row">
        <div class="col-6">
            <h2>Danh sách Tour</h2>
        </div>
        <div class="col-6" style="text-align: end">
            <a href="{{ route('admin.tour_management.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i>
                Thêm Tour
            </a>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr style="text-align:center">
                <th>#</th>
                <th>Tên tour du lịch</th>
                <th>Giá</th>
                <th>Thời gian</th>
                <th>Danh mục</th>
                <th>Địa điểm</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tours as $index => $tour)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tour->name }}</td>
                    <td>{{ number_format($tour->price) }} VNĐ</td>
                    <td>{{ $tour->duration }} ngày</td>
                    <td>{{ $tour->category->name }}</td>
                    <td>{{ $tour->location->name }}</td>
                    <td>
                        <a href="{{ route('admin.tour_management.show', $tour) }}" class="btn btn-info">Xem</a>
                        <a href="{{ route('admin.tour_management.edit', $tour) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('admin.tour_management.destroy', $tour) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
