@extends('admin.layout')
@section('content_admin')
{{-- <a href="{{ route('admins.create') }}" class="btn btn-primary">Thêm Admin</a> --}}
<table class="table">
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
            <a href="" class="btn btn-warning">Sửa</a>
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