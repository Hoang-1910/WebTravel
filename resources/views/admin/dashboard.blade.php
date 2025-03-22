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
                    <canvas id="bookingsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Biểu đồ doanh số theo tháng -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Doanh Số Theo Tháng</div>
                <div class="card-body">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Biểu đồ 5 tour được đặt nhiều nhất -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Top 5 Tour Được Đặt Nhiều Nhất</div>
                <div class="card-body">
                    <canvas id="topToursChart" width="200" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>


</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.umd.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Chuyển Collection thành mảng JSON
        var bookingsData = @json($bookingsByMonth);
        var revenueData = @json($revenueByMonth);
        var months = @json(array_keys($bookingsByMonth));
        var topTourNames = @json($topTours->pluck('name')->all());
        var topTourBookings = @json($topTours->pluck('bookings_count')->all());
        // Vẽ biểu đồ số tour đã đặt theo tháng
        if (months.length > 0) {
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
        } else {
            console.warn("Không có dữ liệu để vẽ biểu đồ bookings.");
        }

        // Vẽ biểu đồ doanh số theo tháng
        if (months.length > 0) {
            new Chart(document.getElementById("revenueChart"), {
                type: "line",
                data: {
                    labels: months,
                    datasets: [{
                        label: "Doanh số (VNĐ)",
                        data: revenueData,
                        backgroundColor: "rgba(255, 99, 132, 0.6)",
                        borderColor: "rgba(255, 99, 132, 1)",
                        borderWidth: 2
                    }]
                },
                options: { responsive: true }
            });
        } else {
            console.warn("Không có dữ liệu để vẽ biểu đồ revenue.");
        }

        // Vẽ biểu đồ top 5 tour được đặt nhiều nhất
        if (topTourNames.length > 0) {
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
                    maintainAspectRatio: false, // Đảm bảo chart không bị kéo giãn
                    plugins: {
                        legend: {
                            position: "bottom", // Di chuyển chú thích xuống dưới
                        }
                    }
                }
            });
        } 
        else {
            console.warn("Không có dữ liệu để vẽ biểu đồ top tours.");
        }
    });
</script>


@endsection


