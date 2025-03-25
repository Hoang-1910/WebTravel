@extends('admin.layout')

@section('content_admin')
<div class="container mt-2">
    <div class="row">
        <div class="col-6">
            <h2>Danh Sách Địa Điểm</h2>
        </div>
        <div class="col-6 text-end">
            <a href="{{ route('admin.locations.create') }}" class="btn btn-primary mb-3">Thêm Địa Điểm Mới</a>
        </div>
    </div>
    {{-- @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif --}}

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Địa Điểm</th>
                <th>Mô Tả</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($locations as $index => $location)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $location->name }}</td>
                    <td>{{ $location->description }}</td>
                    <td>
                        <a href="" class="btn btn-info">Xem</a>
                        <a href="{{ route('admin.locations.edit', $location->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('admin.locations.destroy', $location->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $locations->links() }}
</div>
@endsection
