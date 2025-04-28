@extends('user.layout')

@section('content_user')
<div class="container mt-4 mb-4">
    <div class="row g-4">
        <!-- Carousel Section -->
        <div class="col-lg-8">
            <div id="tourCarousel" class="carousel slide shadow-sm rounded overflow-hidden" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @if($tour->image)
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/' . $tour->image) }}" class="d-block w-100 rounded" style="object-fit: cover; height: 450px;">
                        </div>
                    @endif
                    @foreach ($tourImages as $image)
                        <div class="carousel-item {{ $loop->first && !$tour->image ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image->image) }}" class="d-block w-100 rounded" style="object-fit: cover; height: 450px;">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#tourCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#tourCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>

        <!-- Tour Details -->
        <div class="col-lg-4">
            <div class="card shadow-sm p-3 border-0 rounded">
                <h3 class="text-black font-700">{{ $tour->name }}</h3>
                <p class="fw-bold text-danger fs-5">{{ number_format($tour->price) }} VNĐ</p>
                <p><i class="bi bi-geo-alt-fill text-danger"></i> Điểm xuất phát:  {{ $tour->departureLocation->name ?? 'Không xác định' }}</p>
                <p><i class="bi bi-geo-alt-fill text-danger"></i> Điểm đến: {{ $tour->location->name }}</p>
                <p><i class="bi bi-clock-fill text-warning"></i> Thời gian: {{ $tour->duration }} ngày</p>
                <p><i class="bi bi-people-fill text-info"></i> Số người tối đa: {{ $tour->max_people }}</p>
                @if(Auth::check())
                    <a href="{{ route('booking.order', ['tour' => $tour->id]) }}" class="btn btn-primary w-100 mt-2">
                        Đặt Tour
                    </a>
                @else
                    <button class="btn btn-primary w-100 mt-2" onclick="showLoginAlert()">Đặt Tour</button>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8">
            <!-- Tour Schedule -->
            <div class="row mt-4">
                <h4>Lịch trình tour</h4>
                <div class="col">
                    <div class="accordion" id="tourScheduleAccordion">
                        @if(!empty($tour) && $tour->schedules->count() > 0)
                            @foreach($tour->schedules as $index => $schedule)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false">
                                            <span class="badge bg-dark me-2">Ngày {{ $schedule->day_number }}</span>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $index }}" class="accordion-collapse collapse">
                                        <div class="accordion-body">{!! nl2br(e($schedule->activity)) !!}</div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>Chưa có lịch trình cho tour này</p>
                        @endif
                    </div>
                </div>
            </div>
            
            {{-- Đánh giá tour --}}
            <div class="container p-0">
                <!-- Danh sách đánh giá -->
                <div class="row mt-5">
                    <div class="col">
                        <h5>Đánh giá từ khách hàng</h5>
                        @if($tour->reviews->count() > 0)
                            @foreach($tour->reviews as $review)
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <strong class="me-3">{{ $review->user->name }}</strong>
                                            <p>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <span style="color: {{ $i <= $review->rating ? 'gold' : '#ccc' }}">&#9733;</span>
                                                @endfor
                                            </p>
                                        </div>
                                        <p>{{ $review->comment }}</p>
                                        <small class="text-muted">{{ $review->created_at->format('d/m/Y H:i') }}</small>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>Chưa có đánh giá nào cho tour này.</p>
                        @endif
                    </div>
                </div>

                <!-- Form gửi đánh giá -->
                <div class="row mt-4">
                    <div class="col">
                        @if (Auth::check())
                            <form action="{{ route('reviews.store', $tour->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                                <div class="mb-3 shadow p-3">
                                    <div id="star-rating" class="d-flex justify-content-center" style="font-size: 30px; cursor: pointer; gap: 10px;">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="star" data-value="{{ $i }}">&#9733;</span>
                                        @endfor
                                    </div>
                                    <label class="form-label">Viết đánh giá của bạn:</label>
                                    <input type="hidden" name="rating" id="rating" required>
                                    <textarea name="comment" class="form-control" rows="3" style="min-height: 100px;"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                            </form>
                        @else
                            {{-- <button class="btn btn-primary" onclick="showLoginAlert()">Đăng nhập để đánh giá</button> --}}
                            <p class="text-center">Bạn cần <button class="btn" style="padding: 0;padding-bottom:5px; text-decoration: underline; color: blue;" data-bs-toggle="modal" data-bs-target="#loginModal">Đăng nhập</button> để thực hiện chức năng này</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card card-style m-0 p-4">
                <h3>Tour liên quan</h3>
                @if($relatedTours->count() > 0)
                    @foreach($relatedTours as $relatedTour)
                        <div class="row shadow-sm mb-3 p-2">
                            <div class="col-4">
                                <img src="{{ asset('storage/' . $relatedTour->image) }}" alt="{{ $relatedTour->name }}" class="img-fluid">
                            </div>
                            <div class="col-8">
                                <a class="text-black text_related" style="text-decoration:none; font-weight:bold" href="{{ route('user.detail_tour', ['id' => $relatedTour->id]) }}">{{ $relatedTour->name }}</a>
                                <p class="mb-0" style="font-size: :10px">{{ number_format($relatedTour->price) }} VNĐ</p>
                                <p class="mb-0" style="font-size: :10px">Điểm xuất phát: {{ $relatedTour->departureLocation->name ?? 'Không xác định' }}</p>
                            </div>
                        </div>
                    @endforeach

                @else
                    <p>Không có tour liên quan</p>
                @endif
            </div>
        </div>
    </div>

</div>

<style>
    .star { color: #ccc; }
    .star.selected { color: gold; }
</style>

<script>
    const stars = document.querySelectorAll('#star-rating .star');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const value = star.getAttribute('data-value');
            ratingInput.value = value;
            stars.forEach(s => s.classList.remove('selected'));
            for (let i = 0; i < value; i++) {
                stars[i].classList.add('selected');
            }
        });
    });

    function showLoginAlert() {
        Swal.fire({
            icon: "warning",
            title: "Đăng nhập để sử dụng chức năng này!",
            text: "Bạn cần đăng nhập để sử dụng chức năng này.",
            confirmButtonText: "OK",
            confirmButtonColor: "#3085d6"
        });
    }
</script>
@endsection
