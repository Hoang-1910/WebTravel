@extends('user.layout')

@section('content_user')
<div class="container mt-3 mb-3">
    <h2 class="mb-4">Đổi mật khẩu</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('user.update-password') }}">
        @csrf

        <div class="mb-3">
            <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
            <input type="password" id="current_password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
            @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="new_password" class="form-label">Mật khẩu mới</label>
            <input type="password" id="new_password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" required>
            @error('new_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
    </form>
</div>
@endsection
