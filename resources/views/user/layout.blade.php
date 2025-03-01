<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Du Lịch Việt - Khám Phá Vẻ Đẹp Đất Nước</title>
    
    <!-- CSS -->
    {{-- <link rel="stylesheet" href="css/style.css"> --}}
    {{-- <link rel="stylesheet" href="css/responsive.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="css/auth.css"> --}}
    <!-- Thư viện CSS Bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-contact">
                <span><i class="fas fa-envelope"></i> mien@dulichVietNam</span>
                <span><i class="fas fa-phone"></i> 0973.645.609</span>
            </div>
            <div class="top-links">
                <a href="#"><i class="fas fa-store"></i> Hệ thống giao dịch</a>
                <a href="#"><i class="fas fa-user-plus"></i> Đăng ký đại lý</a>
                <a href="#"><i class="fas fa-comment"></i> Phiếu góp ý</a>
                @if(Auth::check())
                    <span class="text-white ps-3"><i class="fas fa-user"></i> Xin chào, {{ Auth::user()->name }}</span>
                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                
                    <a href="#" class="btn text-white ms-2 pt-0" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Đăng xuất
                    </a>
                @else
                    <button class="btn text-white" data-bs-target="#loginModal" data-bs-toggle="modal">
                        <i class="fas fa-sign-in-alt"></i> Đăng nhập
                    </button>
                    <button class="btn text-white" data-bs-toggle="modal" data-bs-target="#registerModal">
                        <i class="fas fa-user-plus"></i> Đăng ký
                    </button>
                @endif
            </div>
        </div>
    </div>



    <!-- Header -->
    <header class="header">
        <div class="container">
            <nav class="navbar">
                <div class="logo">
                    <a href="/">
                        <img src="{{ asset('storage/tours/logo-dulichnamchau.png') }}" alt="Du Lịch Việt Logo">
                    </a>
                </div>
                <ul class="nav-links">
                    <li><a href="#trang-chu">Trang Chủ</a></li>
                    <li class="dropdown">
                        <a href="#tour">Du lịch <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-content p-0">
                            @foreach($categories as $category)
                                <li><a href="#">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="#ve-may-bay">Vé máy bay</a></li>
                    <li><a href="#khach-san">Khách sạn</a></li>
                    <li><a href="#tin-tuc">Tin tức</a></li>
                    <li><a href="#lien-he">Liên hệ</a></li>
                </ul>
            </nav>
        </div>
    </header>

    @yield('content_user')

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <h3>CÔNG TY CỔ PHẦN TRUYỀN THÔNG DU LỊCH VIỆT</h3>
                    <p><i class="fas fa-map-marker-alt"></i> Trụ sở chính: Cửa Hàng Hạnh Sinh, Thôn 5, Phú Cát, Quốc Oai, Hà Nội.</p>
                    <p><i class="fas fa-map-marker-alt"></i> Chi nhánh TP.Hồ Chí Minh: 239A Hoàng Văn Thụ, Phường 8, Quận Phú Nhuận, TP. Hồ Chí Minh.</p>
                    <p><i class="fas fa-phone"></i> Điện thoại: 0973645609 | Hotline: 1900 0000</p>
                    <p><i class="fas fa-globe"></i> Website: dulichviet.com.vn</p>
                    <p><i class="fas fa-envelope"></i> Email: mien@dulichVietNam.com.vn</p>
                    <div class="license">
                        <p>GIẤY PHÉP KINH DOANH DỊCH VỤ LỮ HÀNH QUỐC TẾ</p>
                        <p>Số GP/No: 79-042/ 2019/TCDL – GPLHQT</p>
                        <p>Do Tổng Cục Du Lịch cấp ngày 11/9/2019</p>
                    </div>
                </div>
                
                <div class="footer-links">
                    <h3>Góc khách hàng</h3>
                    <ul>
                        <li><a href="#">Chính sách đặt tour</a></li>
                        <li><a href="#">Chính sách bảo mật</a></li>
                        <li><a href="#">Ý kiến khách hàng</a></li>
                        <li><a href="#">Phiếu góp ý</a></li>
                    </ul>
                </div>

                <div class="footer-cert">
                    <h3>Chứng nhận</h3>
                    <div class="cert-images">
                        <img src="images/dmca.png" alt="DMCA Protected">
                    </div>
                    <div class="cert-images">
                        <img src="images/bo-cong-thuong.png" alt="Đã thông báo Bộ Công Thương">
                    </div>
                    <h3>Chấp nhận thanh toán</h3>
                    <div class="payment-methods">
                        <img src="images/payment.png" alt="Payment">
                    </div>
                </div>

                <div class="footer-newsletter">
                    <h3>Đăng ký nhận thông tin khuyến mãi</h3>
                    <p>Nhập email để có cơ hội giảm 50% cho chuyến đi tiếp theo của Quý khách</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Email">
                        <button type="submit">Gửi</button>
                    </form>
                </div>
            </div>

            <div class="footer-social">
                <h3>Kết nối với chúng tôi</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
        </div>
    </footer>

    

    <!-- Modal Đăng nhập -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Đăng nhập</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('user.login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" 
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" id="password" name="password" 
                                   class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Đăng nhập</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        {{-- <a href="{{ route('user.register') }}">Chưa có tài khoản? Đăng ký ngay</a> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="text-decoration-none">Quên mật khẩu?</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Đăng ký -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Đăng ký</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registerForm" action="{{ route('user.register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <span class="text-danger error-name"></span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <span class="text-danger error-email"></span>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <span class="text-danger error-password"></span>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="text-decoration-none">Quên mật khẩu?</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#registerForm').on('submit', function(e) {
                e.preventDefault();

                $('.text-danger').text('');
                $('#register-alert').removeClass('alert-success alert-danger').addClass('d-none');

                $.ajax({
                    url: "{{ route('user.register') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        console.log("Sending request...");
                    },
                    success: function(response) {
                        console.log("Response received:", response);
                        $('#register-alert').text(response.success).addClass('alert-success').removeClass('d-none');
                        $('#registerForm')[0].reset();
                        setTimeout(() => $('#registerModal').modal('hide'), 2000);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", xhr);
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.name) $('.error-name').text(errors.name[0]);
                            if (errors.email) $('.error-email').text(errors.email[0]);
                            if (errors.password) $('.error-password').text(errors.password[0]);
                        } else {
                            $('#register-alert').text("Có lỗi xảy ra!").addClass('alert-danger').removeClass('d-none');
                        }
                    }
                });
            });
        });
        </script>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <!-- Thư viện JavaScripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <style>
        .carousel-caption{
            right: 0 !important;
            bottom: 40% !important;
            left: 0 !important;
        }
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Variables */
        :root {
            --primary-color: #ff5722;
            --secondary-color: #2196f3;
            --text-color: #333;
            --light-gray: #f5f5f5;
            --dark-gray: #666;
            --white: #fff;
            --max-width: 1200px;
        }

        /* Global Styles */
        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
        }

        .container {
            max-width: var(--max-width);
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Top Bar */
        .top-bar {
            background: var(--primary-color);
            color: var(--white);
            padding: 10px 0;
        }

        .top-bar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-contact span {
            margin-right: 20px;
        }

        .top-links a {
            color: var(--white);
            text-decoration: none;
            margin-left: 20px;
        }

        /* Header */
        .header {
            background: var(--white);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .logo img {
            height: 50px;
        }

        .nav-links {
            display: flex;
            list-style: none;
        }

        .nav-links li {
            position: relative;
        }

        .nav-links a {
            color: var(--text-color);
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background: var(--white);
            min-width: 200px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            list-style: none;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
        .dropdown-content li:hover{
            background: #eab09f;  
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 87, 34, 0.3);
        }


        /* Hero Section */
        .hero {
            position: relative;
            height: 80vh;
            min-height: 600px;
            overflow: hidden;
        }

        .hero-slider {
            width: 100%;
            height: 100%;
        }


        .swiper-slide {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            width: 100%;
            height: 100%;
            position: relative;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: var(--white);
            z-index: 2;
            width: 100%;
            max-width: 800px;
            padding: 0 20px;
        }

        .hero-content h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .hero-content p {
            font-size: 20px;
            margin-bottom: 30px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        }

        /* Swiper Navigation Buttons */
        .swiper-button-next,
        .swiper-button-prev {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            color: var(--white);
            transition: all 0.3s ease;
            z-index: 10;
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 20px;
            font-weight: bold;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        /* Dark Overlay for Better Text Visibility */
        .hero:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        /* Search Section */
        .search-section {
            margin-top: -50px;
            position: relative;
            z-index: 100;
            padding: 0 15px;
        }

        .search-box {
            background: var(--white);
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .search-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1.5fr;
            gap: 25px;
            align-items: center;
        }

        .search-form {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 0;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            color: var(--dark-gray);
            font-weight: 500;
            font-size: 15px;
        }

        .form-label i {
            margin-right: 8px;
            color: var(--primary-color);
        }

        .form-control {
            width: 100%;
            height: 48px;
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            color: var(--text-color);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(255, 87, 34, 0.1);
            outline: none;
        }

        .btn-primary {
            display: inline-block;
            padding: 12px 30px;
            background: var(--primary-color);
            color: var(--white);
            border: 2px solid var(--primary-color);
            border-radius: 30px;
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(255, 87, 34, 0.2);
        }

        .btn-primary {
            display: inline-block;
            padding: 12px 30px;
            background: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 30px;
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(255, 87, 34, 0.2);
        }

        .btn-primary:hover {
            background: #e64a19;  
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 87, 34, 0.3);
        }

        .btn-secondary {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .btn-secondary:hover {
            background: #0056b3;
        }


        .btn-search {
            width: 100%;
            height: 48px;
            background: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 24px;
        }

        .btn-search:hover {
            background: #e64a19;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255, 87, 34, 0.2);
        }

        .btn-search i {
            margin-right: 8px;
        }

        /* Tour Sections */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        .section-header h2 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-color);
            text-transform: uppercase;
        }

        .view-all {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
        }

        .view-all:hover {
            color: #e64a19;
        }

        .view-all i {
            font-size: 12px;
        }

        /* Tour Grid */
        .tour-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            margin-top: 30px;
            margin-bottom: 50px;
        }

        /* Tour Card */
        .tour-card {
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .tour-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }

        .tour-thumb {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .tour-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .tour-card:hover .tour-thumb img {
            transform: scale(1.05);
        }

        .tour-price {
            position: absolute;
            bottom: 15px;
            right: 15px;
            background: rgba(242, 114, 2, 0.7);
            padding: 8px 15px;
            border-radius: 25px;
            color: white;
        }

        .price {
            font-size: 16px;
            font-weight: 700;
            color: white;
        }

        .price-old {
            font-size: 14px;
            text-decoration: line-through;
            color: #bbb;
            margin-right: 8px;
        }

        .tour-content {
            padding: 20px;
        }

        .tour-content h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            line-height: 1.4;
            height: 45px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .tour-info {
            display: flex;
            gap: 15px;
            margin-bottom: 12px;
            color: var(--dark-gray);
            font-size: 14px;
        }

        .tour-info span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .tour-meta {
            padding: 12px 0;
            border-top: 1px solid #eee;
            color: var(--dark-gray);
            font-size: 14px;
        }

        .tour-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Services Section */
        .services {
            padding: 50px 0;
            background: #f8f9fa;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .service-item {
            display: flex;
            align-items: center;
            padding: 25px;
            border-radius: 10px;
            color: white;
            transition: transform 0.3s ease;
        }

        .service-item:hover {
            transform: translateY(-5px);
        }

        .service-item i {
            font-size: 30px;
            margin-right: 15px;
        }

        .service-content h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .service-content p {
            font-size: 14px;
            opacity: 0.9;
        }

        /* Service Colors */
        .pink { background: #E91E63; }
        .blue { background: #2196F3; }
        .orange { background: #F4511E; }
        .teal { background: #009688; }

        /* Footer */
        .footer {
            background: #1a1a1a;
            color: #fff;
            padding: 50px 0 0;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .footer h3 {
            color: #fff;
            font-size: 18px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .footer-info p {
            margin-bottom: 10px;
            color: #bbb;
            font-size: 14px;
        }

        .footer-info i {
            margin-right: 10px;
            color: var(--primary-color);
        }

        .license {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #333;
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links a {
            color: #bbb;
            text-decoration: none;
            display: block;
            padding: 8px 0;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--primary-color);
        }

        .cert-images, .payment-methods {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .cert-images img, .payment-methods img {
            height: 40px;
            object-fit: contain;
        }

        .cert-images:nth-child(2) {
            margin-top: 15px;
        }

        .newsletter-form {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .newsletter-form input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid #333;
            background: #333;
            color: #fff;
            border-radius: 5px;
        }

        .newsletter-form button {
            padding: 10px 20px;
            background: var(--primary-color);
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .newsletter-form button:hover {
            background: #e64a19;
        }

        .footer-social {
            text-align: center;
            padding: 30px 0;
            border-top: 1px solid #333;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            background: #333;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .tour-card {
            animation: fadeIn 0.5s ease forwards;
        }
    </style>
</body>
</html>