@extends('user.layout')

@section('content_user')
<div class="container mt-4 mb-3 d-flex justify-content-center w-100">
    <div class="row">
        <h3 class="mb-3">Đặt Tour - {{ $tour->name }}</h3>
        <!-- Form nhập thông tin -->
        <div class="col-md-6">
            <form action="{{ route('bookings.store', $tour->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Họ và tên</label>
                    <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" value="{{ $user->phone ?? 'Chưa cập nhật' }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ngày xuất phát *</label>
                    <input type="date" name="departure_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Số khách *</label>
                    <input type="number" name="num_people" class="form-control" min="1" max="{{ $tour->max_people }}" required>
                </div>
                <div class="mb-3">
                    <p><strong>Tổng tiền:</strong> <span id="total_price">0</span></p>
                </div>
                <button type="submit" class="btn btn-primary">Xác nhận đặt tour</button>
            </form>
        </div>

        <!-- Hiển thị thông tin tour -->
        <div class="col-md-6">
            <div class="card">
                <img src="{{ asset('storage/' . $tour->image) }}" class="card-img-top" alt="{{ $tour->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $tour->name }}</h5>
                    <p><strong>Giá 1 khách:</strong> {{ number_format($tour->price, 0, ',', '.') }} VND</p>
                    <p><strong>Thời gian:</strong> {{ $tour->duration }} ngày</p>
                    <p><strong>Mô tả:</strong> {{ $tour->description }}</p>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
     document.addEventListener("DOMContentLoaded", function() {
        let successMessage = "{{ session('success') }}";
        if (successMessage) {
            Swal.fire({
                title: "Đặt tour thành công!",
                text: "Cảm ơn bạn đã đặt tour. Chúng tôi sẽ liên hệ sớm nhất.",
                icon: "success",
                confirmButtonText: "OK"
            });
        }
    });
document.addEventListener("DOMContentLoaded", function () {
    // Lấy các phần tử input
    let numPeopleInput = document.querySelector("input[name='num_people']");
    let departureDateInput = document.querySelector("input[name='departure_date']");
    let totalPriceElement = document.getElementById("total_price");

    // Giá mỗi người và số khách tối đa
    let pricePerPerson = {{ $tour->price }};
    let maxPeople = {{ $tour->max_people }};

    // Đặt giá trị min cho ngày xuất phát (không cho chọn ngày quá khứ)
    let today = new Date().toISOString().split("T")[0];
    departureDateInput.setAttribute("min", today);

    // Kiểm tra số khách nhập vào
    numPeopleInput.addEventListener("input", function () {
        let numPeople = parseInt(this.value) || 0;

        if (numPeople > maxPeople) {
            Swal.fire({
                icon: "warning",
                title: "Quá số khách cho phép!",
                text: "Số khách tối đa là " + maxPeople + " người.",
                confirmButtonText: "OK",
                timer: 3000,
                timerProgressBar: true
            });

            this.value = maxPeople;
            numPeople = maxPeople;
        }

        // Cập nhật tổng giá
        totalPriceElement.innerText = (numPeople * pricePerPerson).toLocaleString() + " VND";
    });
});
</script>


    
@endsection
