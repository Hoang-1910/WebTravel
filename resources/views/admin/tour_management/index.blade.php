@extends('admin.layout')

@section('content_admin')
    <div class="row mb-4">
        <div class="col-4" style="width:52% !important;">
            <h2>Danh sách Tour</h2>
        </div>
        
        <form action="{{ route('admin.tour_management.index') }}" method="GET" class="position-relative col-4">
            <input type="text" name="search" class="form-control me-2" placeholder="Tìm kiếm tour theo tên..." value="{{ $search ?? '' }}">
            <button type="submit" class="btn position-absolute h-100" style="right: 10px; top:0"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

        <div class="col-3" style="width:14% !important;">
            <a href="{{ route('admin.tour_management.create') }}" class="btn btn-primary h-100 d-flex align-items-center">
                <i class="fa-solid fa-plus pe-2"></i>
                Thêm Tour
            </a>
        </div>
    </div>
    {{-- @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif --}}

    <table class="table">
        <thead>
            <tr style="text-align:center">
                <th>#</th>
                <th style="width:500px;">Tên tour du lịch</th>
                <th>Giá</th>
                <th>Thời gian</th>
                <th>Danh mục</th>
                <th>Địa điểm</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tours as $index => $tour)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tour->name }}</td>
                    <td>{{ number_format($tour->price) }} VNĐ</td>
                    <td>{{ $tour->duration }} ngày</td>
                    <td>{{ $tour->category->name }}</td>
                    <td>{{ $tour->location->name }}</td>
                    <td>
                        <a href="{{ route('admin.tour_management.show', $tour) }}" class="btn btn-info">Xem</a>
                        <a href="{{ route('admin.tour_management.edit', $tour) }}" class="btn btn-warning">Sửa</a>
                        <!-- Nút Xóa -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-delete-url="{{ route('admin.tour_management.destroy', $tour->id) }}">
                            Xóa
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $tours->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
    


    <!-- Modal Xác Nhận Xóa -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Xác nhận xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa mục này không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xác nhận xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const deleteButtons = document.querySelectorAll("[data-bs-toggle='modal']");
    
            deleteButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const deleteUrl = this.getAttribute("data-delete-url");
                    document.getElementById("deleteForm").setAttribute("action", deleteUrl);
                });
            });
        });
    </script>
@endsection


