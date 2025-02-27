<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/5e4f3dce79.js" crossorigin="anonymous"></script>
</head>
<body style="background-color: #f6f6f6; display:flex;">
    <header class="header" style="width: 20% !important;">
        <div class="container bg-white" style="min-height:690px !important;">
            <ul class="header-content" style="padding: 40px 0;">
                <li class="header-item"><a href="{{ route('admin.dashboard') }}" class="header-link">Trang chủ</a></li>
                <li class="header-item"><a href="{{ route('admin.tour_management.index') }}" class="header-link">Quản lý Tour</a></li>
                <li class="header-item"><a href="{{ route('admin.categories.index') }}" class="header-link">Quản lý Category</a></li>
                <li class="header-item"><a href="{{ route('admin.locations.index') }}" class="header-link">Quản lý Location</a></li>
                <li class="header-item"><a href="" class="header-link">Quản lý đặt Tour</a></li>
                <li class="header-item"><a href="" class="header-link">Quản lý người dùng</a></li>
                <li class="header-item"><a href="" class="header-link">Quản lý đánh giá</a></li>
                <li class="header-item"><a href="" class="header-link">Quản lý khách sạn</a></li>
                <li class="header-item"><a href="" class="header-link">Quản lý lịch trình</a></li>
                <li class="header-item"><a href="{{ route('admin.account_admin.index') }}" class="header-link">Quản lý tài khoản admin</a></li>
            </ul>
        </div>
    </header>
    <div class="container mt-3" style="max-height:715px; overflow:scroll"">
        <div class="container d-flex justify-content-between">
            <h2>Chào mừng, {{ session('admin')->name }}!</h2>
            <a href="{{ route('admin.logout') }}" class="btn btn-danger">Đăng xuất</a>
        </div>
        <div class="container bg-white p-3 mt-3" style="border-radius:10px;">
            @yield('content_admin')
        </div>
    </div>
    <footer class="footer">

    </footer>

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
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>