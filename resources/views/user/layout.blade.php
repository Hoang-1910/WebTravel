<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Du Lịch Việt - Khám Phá Vẻ Đẹp Đất Nước</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Thư viện CSS Bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar text-white py-2">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Thông tin liên hệ -->
            <div class="top-contact">
                <span><i class="fas fa-envelope"></i> mien@dulichVietNam</span>
                <span class="ms-3"><i class="fas fa-phone"></i> 0973.645.609</span>
            </div>
    
            <!-- Liên kết -->
            <div class="top-links d-flex align-items-center" style="white-space: nowrap;">
                <a href="#" class="text-white me-3"><i class="fas fa-store"></i> Hệ thống giao dịch</a>
                <a href="#" class="text-white me-3"><i class="fas fa-user-plus"></i> Đăng ký đại lý</a>
                <a href="#" class="text-white me-3"><i class="fas fa-comment"></i> Phiếu góp ý</a>
    
                @auth
                <i class="fas fa-user pe-2"></i> Xin chào, {{ Auth::user()->name }}!
                <div class="dropdown">
                    <a class="btn text-white dropdown-toggle-custom ms-0">
                        <i class="fa-solid fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu p-0 m-0" style="overflow: hidden; left: -135px;">
                        <li><a class="dropdown-item text-black ms-0" href="{{ route('user.profile') }}">Xem thông tin</a></li>
                        <li><a class="dropdown-item text-black ms-0" href="{{ route('booked-tours') }}">Xem tour đã đặt</a></li>
                        <li><a class="dropdown-item text-black ms-0" href="{{ route('user.change-password') }}">Đổi mật khẩu</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger ms-0" href="{{ route('user.logout') }}"><i class="fas fa-sign-out-alt pe-1"></i>Đăng xuất</a></li>
                    </ul>
                </div>                
                @else
                    <a href="#" class="text-white me-3" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fas fa-sign-in-alt"></i> Đăng Nhập</a>
                    <a href="#" class="text-white" data-bs-toggle="modal" data-bs-target="#registerModal"><i class="fas fa-user-plus"></i> Đăng Ký</a>
                @endauth
            </div>
        </div>
    </div>
    



    <!-- Header -->
    <header class="header">
        <div class="container">
            <nav class="navbar">
                <div class="logo">
                    <a href="{{ route('user.homepage') }}">
                        <img src="{{ asset('storage/tours/logo-dulichnamchau.png') }}" alt="Du Lịch Việt Logo">
                    </a>
                </div>
                <ul class="nav-links">
                    <li><a href="{{ route('user.homepage') }}">Trang Chủ</a></li>
                    <li class="dropdown">
                        <a href="#tour">Du lịch <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-content p-0">
                            @foreach($categories as $category)
                                <li class="nav-item">
                                    <a class="nav-link"" href="{{ route('user.category_tour', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                </li>
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
                    <a href="{{ route('user.reset_password') }}" class="text-decoration-none">Quên mật khẩu?</a>
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

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <!-- Thư viện JavaScripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    
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