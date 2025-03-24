<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/5e4f3dce79.js" crossorigin="anonymous"></script>
    <style>
        .header-link:hover {
            background-color: #2a303d;
        }
        .header-link {
            font-weight:normal !important;
            font-size: 15px !important;
        }
        .header-item {
            padding: 0 !important;
        }
        .pagination {
            padding-left: 20px !important;
        }
    </style>
</head>
<body style="background-color: #f6f6f6; display:flex; min-height: 700px !important;">
    <header class="header" style="width: 20% !important;background-color: #323a49; max-height: 700px !important;">
        <div class="container text-white p-0" style="max-height: 700px !important;">
            <h2 class="text-center p-3 pb-0 m-0">Web Travel</h2>
            <ul class="header-content text-white" style="padding: 0; list-style-type: none;">
                <li class="header-item"><a href="{{ route('admin.dashboard') }}" class="header-link text-white px-3"><i class="fa-solid fa-house me-2"></i>Trang chủ</a></li>
                <li class="header-item"><a href="{{ route('admin.tour_management.index') }}" class="header-link text-white px-3"><i class="fa-solid fa-plane-departure me-2"></i>Quản lý Tour</a></li>
                <li class="header-item"><a href="{{ route('admin.categories.index') }}" class="header-link text-white px-3"><i class="fa-solid fa-layer-group me-2"></i>Quản lý Category</a></li>
                <li class="header-item"><a href="{{ route('admin.locations.index') }}" class="header-link text-white px-3"><i class="fa-solid fa-location-dot me-2"></i>Quản lý Location</a></li>
                <li class="header-item"><a href="{{ route('admin.bookings.index') }}" class="header-link text-white px-3"><i class="fa-solid fa-cart-shopping me-2"></i>Quản lý đặt Tour</a></li>
                <li class="header-item"><a href="{{ route('admin.account_user.index') }}" class="header-link text-white px-3"><i class="fa-solid fa-users me-2"></i>Quản lý người dùng</a></li>
                <li class="header-item"><a href="{{ route('admin.sliders.index') }}" class="header-link text-white px-3"><i class="fa-solid fa-sliders me-2"></i>Quản lý Slider</a></li>
                <li class="header-item"><a href="{{ route('admin.hotels.index') }}" class="header-link text-white px-3"><i class="fa-solid fa-hotel me-2"></i>Quản lý khách sạn</a></li>
                <li class="header-item"><a href="{{ route('admin.account_admin.index') }}" class="header-link text-white px-3"><i class="fa-solid fa-gears me-2"></i>Quản lý tài khoản admin</a></li>
            </ul>
        </div>
    </header>
    <div class="container mt-3" style="">
        @if(session()->has('admin'))
            {{-- <div class="container d-flex justify-content-between">
                <h2>Chào mừng, {{ session('admin')->name }}!</h2>
                <a href="{{ route('admin.logout') }}" class="btn btn-danger">Đăng xuất</a>
            </div> --}}
            <div class="container bg-white d-flex justify-content-end align-items-center"  style="border-radius:20px;">
                {{-- <div class="search_input position-relative" style="width: 350px">
                    <input type="text" class="form-control" placeholder="Tìm kiếm..." style="height: 40px;">
                    <div class="search_icon position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                        <i class="fas fa-search"></i>
                    </div>
                </div> --}}
                <div class="d-flex align-items-center p-3">
                    <img class="me-1" width="35" src="{{ asset('storage/tours/manager.png') }}" alt="">
                    <h5 class="mb-0">{{ session('admin')->name }}</h5>
                    <div class="dropdown">
                        <a class="btn d-flex align-items-center dropdown-toggle-custom ms-0">
                            <i class="fa-solid fa-chevron-down text-black"></i>
                        </a>
                        <ul class="dropdown-menu p-0 m-0" style="overflow: hidden; left: -135px;">
                            <li><a href="{{ route('admin.info') }}" class="dropdown-item border-bottom p-2">Xem thông tin</a></li>
                            <li><a class="dropdown-item text-danger ms-0 p-2" href="{{ route('admin.logout') }}"><i class="fas fa-sign-out-alt pe-1"></i>Đăng xuất</a></li>
                        </ul>
                    </div>  
                </div>
            </div>
        @else
            <script>window.location.href = "{{ route('admin.login') }}";</script>
        @endif
    
        <div class="container bg-white p-3 mt-3" style="border-radius:10px;">
            @yield('content_admin')
        </div>
    </div>

    <style>
        .header-link {
            text-decoration: none;
            color: #000;
            font-weight: bold;
            height: 65px;
            align-items: center;
            display: flex;
            width: 100%;
        }
        .header-item {
            padding-left: 10px;
        }
        .truncate-text {
            width: 150px; /* Giới hạn chiều rộng */
            white-space: nowrap; /* Không xuống dòng */
            overflow: hidden; /* Ẩn phần dư thừa */
            text-overflow: ellipsis; /* Hiển thị dấu ... */
            max-width: 500px !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            })
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            })
        </script>
    @endif
</body>
</html>