@extends('user.layout')

@section('content_user')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm p-4 border-0 rounded">
                    <h3 class="text-center text-primary">Đặt Tour: {{ $tour->name }}</h3>
                    <p class="text-center text-muted">Điểm đến: {{ $tour->location->name }} | {{ $tour->duration }} ngày</p>
                    
                    <form action="{{ route('tour.book', $tour->id) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Họ và Tên</label>
                            <input type="text" id="full_name" name="full_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" id="phone" name="phone" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="num_people" class="form-label">Số người</label>
                            <input type="number" id="num_people" name="num_people" class="form-control" min="1" max="{{ $tour->max_people }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="date" class="form-label">Ngày khởi hành</label>
                            <input type="date" id="date" name="date" class="form-control" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Xác nhận Đặt Tour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
