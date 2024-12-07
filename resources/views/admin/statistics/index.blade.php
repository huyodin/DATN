@extends('layout.app_user')

@section('content')
    <div class="container-lg mt-5 bg-white p-4 shadow-sm rounded">
        <h1 class="text-center mt-3 text-primary">Thống Kê Đặt Tour</h1>

        <div class="mb-3 text-center">
            <form method="GET" action="{{ route('admin.statistics.index') }}" class="d-inline">
                @if($previousYear)
                    <input type="hidden" name="year" value="{{ $previousYear }}">
                    <button type="submit" class="btn btn-outline-primary px-4 py-2">&laquo; Năm Trước</button>
                @endif
            </form>
            <span class="mx-2">Năm: {{ $selectedYear }}</span>
            <form method="GET" action="{{ route('admin.statistics.index') }}" class="d-inline">
                @if($nextYear)
                    <input type="hidden" name="year" value="{{ $nextYear }}">
                    <button type="submit" class="btn btn-outline-primary px-4 py-2">Năm Sau &raquo;</button>
                @endif
            </form>
        </div>

        <!-- Tổng Quan -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                Tổng Quan (Năm {{ $selectedYear }})
            </div>
            <div class="card-body">
                <p><strong>Tổng số tour:</strong> {{ $totalTours }}</p>
                <p><strong>Tổng số lượt đặt tour:</strong> {{ $totalBookings }}</p>
                <p><strong>Tổng số người lớn:</strong> {{ $totalAdults }}</p>
                <p><strong>Tổng số trẻ em:</strong> {{ $totalChildren }}</p>
                <p><strong>Tổng doanh thu:</strong> {{ number_format($totalRevenue) }},000VND</p>
            </div>
        </div>

        <!-- Biểu Đồ Thống Kê -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                Biểu Đồ Thống Kê Số Lượt Đặt Tour Theo Tháng (Năm {{ $selectedYear }})
            </div>
            <div class="card-body">
                <canvas id="bookingsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('bookingsChart').getContext('2d');
            const bookingsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($months) !!},
                    datasets: [{
                        label: 'Số lượt đặt tour',
                        data: {!! json_encode($bookingsCount) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const vietnameseMonths = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];
            bookingsChart.data.labels = vietnameseMonths;
            bookingsChart.update();
        });
    </script>
@endsection
