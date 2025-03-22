@extends('admin.layout')

@section('content_admin')

<div class="container mt-4">
    <h2 class="mb-4">Thêm Admin</h2>
    <form action="{{ route('admin.account_admin.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group"></div>
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Thêm</button>
    </form>
</div>
@endsection