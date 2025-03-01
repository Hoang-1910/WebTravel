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
                    <p><i class="bi bi-geo-alt-fill text-danger"></i> Điểm đến: {{ $tour->location->name }}</p>
                    <p><i class="bi bi-clock-fill text-warning"></i> Thời gian: {{ $tour->duration }} ngày</p>
                    <p><i class="bi bi-people-fill text-info"></i> Số người tối đa: {{ $tour->max_people }}</p>
                    <a href="#" class="btn btn-primary w-100 mt-2">Đặt Tour</a>
                </div>
            </div>
        </div>
        
        <!-- Tour Schedule -->
        <div class="row mt-4">
            <h4>Lịch trình tour</h4>
            <div class="col-lg-8">
                <div class="accordion" id="tourScheduleAccordion">
                    @foreach($tour->schedules as $index => $schedule)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $index }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false">
                                    <span class="badge bg-dark me-2">Ngày {{ $schedule->day_number }}</span>
                                </button>
                            </h2>
                            <div id="collapse{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#tourScheduleAccordion">
                                <div class="accordion-body">{{ $schedule->activity }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
