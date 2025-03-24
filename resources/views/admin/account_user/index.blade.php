@extends('admin.layout')

@section('content_admin')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2>Danh sách người dùng</h2>
         <!-- Form tìm kiếm -->
        <form action="{{ route('admin.account_user.index') }}" method="GET" class="position-relative mb-3" style="width: 350px">
            <input type="text" name="search" class="form-control me-2" placeholder="Tìm theo tên hoặc email" value="{{ request('search') }}">
            <button type="submit" class="btn position-absolute h-100" style="right: 0; top:0"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
    
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $key => $user)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role ?? 'Người dùng' }}</td>
                <td>
                    <form action="{{ route('admin.account_user.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Phân trang -->
    <div class="d-flex justify-content-center mt-4">
        {{ $users->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
