@extends('admin.layout')

@section('content_admin')
<div class="container mt-4">
    <h2 class="mb-4">Dashboard</h2>

    <div class="row">
        <!-- Biểu đồ số tour đã đặt theo tháng -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Số Tour Đã Đặt Theo Tháng</div>
                <div class="card-body">
                    @if (array_sum($bookingsByMonth) > 0)
                        <canvas id="bookingsChart"></canvas>
                    @else
                        <p class="text-center text-muted">Không có dữ liệu để hiển thị.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Biểu đồ doanh số theo tháng -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Doanh Số Theo Tháng</div>
                <div class="card-body">
                    @if (array_sum($revenueByMonth) > 0)
                        <canvas id="revenueChart"></canvas>
                    @else
                        <p class="text-center text-muted">Không có dữ liệu để hiển thị.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Biểu đồ 5 tour được đặt nhiều nhất theo tháng -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Top 5 Tour Được Đặt Nhiều Nhất Theo Tháng</span>
                    <form method="GET" action="{{ route('admin.dashboard') }}" class="d-flex align-items-center">
                        <label class="me-2 mb-0" for="month" style="white-space:nowrap;">Chọn tháng:</label>
                        <input type="month" id="month" name="month" value="{{ $selectedMonth }}" class="form-control me-2">
                        <button type="submit" class="btn btn-primary">Lọc</button>
                    </form>
                </div>
                <div class="card-body">
                    @if (count($topTourNames) > 0)
                        <canvas id="topToursChart" width="200" height="200"></canvas>
                    @else
                        <p class="text-center text-muted">Không có dữ liệu để hiển thị.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.umd.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var bookingsData = @json(array_values($bookingsByMonth));
        var revenueData = @json(array_values($revenueByMonth));
        var months = @json(array_keys($bookingsByMonth));

        var topTourNames = @json($topTourNames);
        var topTourBookings = @json($topTourBookings);

        if (months.length > 0 && bookingsData.some(value => value > 0)) {
            new Chart(document.getElementById("bookingsChart"), {
                type: "bar",
                data: {
                    labels: months,
                    datasets: [{
                        label: "Số tour đã đặt",
                        data: bookingsData,
                        backgroundColor: "rgba(75, 192, 192, 0.6)",
                        borderColor: "rgba(75, 192, 192, 1)",
                        borderWidth: 1
                    }]
                },
                options: { responsive: true }
            });
        }

        if (months.length > 0 && revenueData.some(value => value > 0)) {
            new Chart(document.getElementById("revenueChart"), {
                type: "line",
                data: {
                    labels: months,
                    datasets: [{
                        label: "Doanh số (VNĐ)",
                        data: revenueData,
                        fill: false,
                        borderColor: "rgba(255, 99, 132, 1)",
                        backgroundColor: "rgba(255, 99, 132, 0.6)",
                        tension: 0.1
                    }]
                },
                options: { responsive: true }
            });
        }

        if (topTourNames.length > 0 && topTourBookings.some(value => value > 0)) {
            new Chart(document.getElementById("topToursChart"), {
                type: "pie",
                data: {
                    labels: topTourNames,
                    datasets: [{
                        label: "Số lượt đặt",
                        data: topTourBookings,
                        backgroundColor: ["#ff6384", "#36a2eb", "#ffcd56", "#4bc0c0", "#9966ff"],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: "bottom",
                        }
                    }
                }
            });
        }
    });
</script>
@endsection
