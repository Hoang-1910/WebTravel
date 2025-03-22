@extends('user.layout')

@section('content_user')
<div class="container mt-3 mb-3">
    <h2>Chỉnh Sửa Thông Tin</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('user.updateProfile') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Họ và Tên</label>
            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Số Điện Thoại</label>
            <input type="text" name="phone" class="form-control" value="{{ auth()->user()->phone }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày Sinh</label>
            <input type="date" name="birthday" class="form-control" value="{{ auth()->user()->birthday }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Địa Chỉ</label>
            <input type="text" name="address" class="form-control" value="{{ auth()->user()->address }}">
        </div>

        <button type="submit" class="btn btn-success">Lưu Thay Đổi</button>
        <a href="{{ route('user.profile') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
