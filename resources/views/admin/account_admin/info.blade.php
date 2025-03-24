@extends('admin.layout') {{-- Thay bằng layout mà bạn đang sử dụng nếu khác --}}

@section('content_admin')
<div class="container py-4">
    <div class="card shadow p-4" style="border-radius: 20px;">
        <h3 class="text-center mb-4">Thông tin tài khoản Admin</h3>
        <div class="d-flex justify-content-center mb-4">
            <img src="{{ asset('storage/tours/manager.png') }}" alt="avatar" width="120" class="rounded-circle border border-2">
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <strong>Họ và tên:</strong>
                <div class="form-control bg-light">{{ $admin->name }}</div>
            </div>
            <div class="col-md-6 mb-3">
                <strong>Email:</strong>
                <div class="form-control bg-light">{{ $admin->email }}</div>
            </div>
            <div class="col-md-6 mb-3">
                <strong>Số điện thoại:</strong>
                <div class="form-control bg-light">{{ $admin->phone ?? 'Chưa cập nhật' }}</div>
            </div>
            <div class="col-md-6 mb-3">
                <strong>Ngày tạo tài khoản:</strong>
                <div class="form-control bg-light">{{ $admin->created_at->format('d/m/Y') }}</div>
            </div>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Quay lại
            </a>
            {{-- <a href="{{ route('admin.change_password') }}" class="btn btn-primary">
                <i class="fa-solid fa-key me-1"></i> Đổi mật khẩu
            </a> --}}
        </div>
    </div>
</div>
@endsection
