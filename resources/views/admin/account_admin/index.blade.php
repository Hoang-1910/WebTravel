@extends('admin.layout')

@section('content_admin')
    <div class="d-flex justify-content-between">
        <h3>Danh sách tài khoản admin</h3>
        <a href="{{ route('admin.account_admin.create') }}" class="btn btn-primary">Thêm Admin</a>
    </div>
    @if(session('success'))
            <div class="alert alert-success mt-3 mb-3">{{ session('success') }}</div>
        @endif
    <table class="table mt-2">
        <tr>
            <th>#</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Hành động</th>
        </tr>
        @foreach($admins as $index => $admin)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $admin->name }}</td>
            <td>{{ $admin->email }}</td>
            <td>
                <form action="{{ route('admin.account_admin.destroy', $admin->id) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $admins->links() }}
@endsection