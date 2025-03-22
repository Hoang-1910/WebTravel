@extends('admin.layout')

@section('content_admin')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Quản lý Slider</h3>
        <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">Thêm slider mới</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped" style="border-radius: 10px; overflow: hidden;">
        <thead>
            <tr class="text-center">
                <th>Hình ảnh</th>
                <th>Tiêu đề</th>
                <th>Tiêu đề phụ</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sliders as $slider)
                <tr>
                    <td class="text-center"><img src="{{ asset('storage/' . $slider->image) }}" alt="slider" width="120"></td>
                    <td>{{ $slider->title }}</td>
                    <td>{{ $slider->subtitle }}</td>
                    <td>
                        <span class="badge {{ $slider->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $slider->is_active ? 'Đang sử dụng' : 'Không sử dụng' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection