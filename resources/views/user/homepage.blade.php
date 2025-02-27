@extends('user.layout')

@section ('content_user')
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" style="max-height:550px !important;">
            <img src="{{ asset('storage/tours/slide_1.webp') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h1>Khám Phá Vẻ Đẹp Việt Nam</h1>
                <p>Trải nghiệm những chuyến đi đáng nhớ cùng chúng tôi</p>
            </div>
            </div>
            <div class="carousel-item" style="max-height:550px !important;">
            <img src="{{ asset('storage/tours/slide_2.jpg') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h1>Tour Ghép Đoàn Giá Tốt</h1>
                <p>Tiết kiệm chi phí - Dịch vụ chất lượng</p>
            </div>
            </div>
            <div class="carousel-item" style="max-height:550px !important;">
            <img src="{{ asset('storage/tours/slide_3.jpg') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h1>Tour Ghép Đoàn Giá Tốt</h1>
                <p>Tiết kiệm chi phí - Dịch vụ chất lượng</p>
            </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Search Section -->
    <section class="search-section">
        <div class="container">
            <div class="search-box">
                <form class="search-form">
                    <div class="search-grid">
                        <div class="form-group">
                            <label class="form-label"><label><i class="fas fa-map-marker-alt"></i> Điểm đến</label></label>
                            <select name="destination" class="form-control" required>
                                <option value="">Chọn điểm đến</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <i class="far fa-calendar-alt"></i>
                                Ngày đi
                            </label>
                            <input type="date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-users"></i>
                                Số người
                            </label>
                            <input type="number" class="form-control" min="1" value="1" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-search">
                                <i class="fas fa-search"></i>
                                Tìm Tour
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div class="container">
        @foreach($categories as $category)
            <section class="tour-domestic">
                <div class="container">
                    <div class="section-header">
                        <h2>{{ $category->name }}</h2>
                        <a href="{{ route('user.category_tour', ['category' => $category->id]) }}" class="view-all">Xem tất cả <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </section>
            <section class="tour-sale">
                <div class="container">
                    <div class="tour-grid">
                        <!-- Tour Card 1 -->
                        @foreach($category->tours->shuffle()->take(4) as $tour)       
                        <div class="tour-card">
                                <div class="tour-thumb">
                                    <img src="{{ asset('storage/' . $tour->image) }}" alt="{{ $tour->name }}">
                                    <div class="tour-price">
                                        <p class="mb-0"><strong>Giá:</strong> {{ number_format($tour->price, 0, ',', '.') }} VND</p>
                                    </div>
                                </div>
                                <div class="tour-content">
                                    <h3>{{ $tour->name }}</h3>
                                    <div class="tour-info">
                                        <span><i class="far fa-clock"></i>{{ $tour->duration }} ngày</span>
                                        <span><i class="fas fa-map-marker-alt"></i>{{ $tour->location ? $tour->location->name : 'Không xác định'  }}</span>
                                    </div>
                                    <a href="" class="btn-secondary">Xem chi tiết</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endforeach
    </div>

    <!-- Services Section -->
    <section class="services">
        <div class="container">
            <div class="services-grid">
                <div class="service-item pink">
                    <i class="fas fa-hotel"></i>
                    <div class="service-content">
                        <h3>KHÁCH SẠN</h3>
                        <p>Khách sạn tốt nhất tại các địa điểm du lịch nổi tiếng.</p>
                    </div>
                </div>
                <div class="service-item blue">
                    <i class="fas fa-car"></i>
                    <div class="service-content">
                        <h3>THUÊ XE</h3>
                        <p>Dịch vụ thuê xe giá tốt từ các nhà xe uy tín và chu đáo.</p>
                    </div>
                </div>
                <div class="service-item orange">
                    <i class="fas fa-passport"></i>
                    <div class="service-content">
                        <h3>VISA</h3>
                        <p>Dịch vụ Visa nhanh, rẻ. Visa trọn gói, thủ tục đơn giản.</p>
                    </div>
                </div>
                <div class="service-item teal">
                    <i class="fas fa-plane"></i>
                    <div class="service-content">
                        <h3>VÉ MÁY BAY</h3>
                        <p>Vé máy bay giá rẻ nhất, nhiều khuyến mãi hấp dẫn.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
