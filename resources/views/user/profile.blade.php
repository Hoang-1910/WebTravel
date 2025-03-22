@extends('user.layout')

@section('content_user')
<div class="container mt-3 mb-3">
    <h2>Thông Tin Cá Nhân</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Họ và Tên:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><strong>Số Điện Thoại:</strong> {{ auth()->user()->phone ?? 'Chưa cập nhật' }}</p>
            <p><strong>Ngày Sinh:</strong> {{ auth()->user()->birthday ?? 'Chưa cập nhật' }}</p>
            <p><strong>Địa Chỉ:</strong> {{ auth()->user()->address ?? 'Chưa cập nhật' }}</p>
            
            <!-- Nút chuyển đến trang chỉnh sửa -->
            <a href="{{ route('user.editProfile') }}" class="btn btn-primary">Sửa Thông Tin</a>
        </div>
    </div>
</div>
@endsection
