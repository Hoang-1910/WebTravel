@extends('admin.layout')

@section('content_admin')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h2>Danh Sách Khách Sạn</h2>
            <a href="{{ route('admin.hotels.create') }}" class="btn btn-primary mb-3"><i class="fa-solid fa-plus pe-2"></i>Thêm Khách Sạn Mới</a>
        </div>
    
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Khách Sạn</th>
                    <th>Địa Chỉ</th>
                    <th>Rating</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hotels as $index => $hotel)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-start">{{ $hotel->name }}</td>
                        <td>{{ $hotel->location->name }}</td>
                        <td>
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $hotel->rating)
                                    <i class="fas fa-star text-warning"></i> {{-- Sao đầy --}}
                                @else
                                    <i class="far fa-star text-muted"></i> {{-- Sao rỗng --}}
                                @endif
                            @endfor
                        </td>
                        <td>
                            <a href="{{ route('admin.hotels.edit', ['hotel' => $hotel->id]) }}" class="btn btn-warning">Sửa</a>
                            
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" 
                                data-id="{{ $hotel->id }}">
                                Xóa
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->  
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa khách sạn này không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var deleteModal = document.getElementById("deleteModal");
            var deleteForm = document.getElementById("deleteForm");

            deleteModal.addEventListener("show.bs.modal", function (event) {
                var button = event.relatedTarget; 
                var hotelId = button.getAttribute("data-id"); 

                var actionUrl = "{{ route('admin.hotels.destroy', '') }}/" + hotelId;
                deleteForm.setAttribute("action", actionUrl);
            });
        });
    </script>

@endsection