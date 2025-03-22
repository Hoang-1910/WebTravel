@extends('user.layout')

@section('content_user')
<div class="container mt-3 mb-3">
    <h2>Quên Mật Khẩu</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('user.forgot_password') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Nhập Email của bạn:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Reset Mật Khẩu</button>
    </form>
</div>
@endsection
