@extends('main')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Total Products Card -->
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card shadow-lg bg-white rounded-lg">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Total Products</h5>
                                <p class="card-text text-muted">Manage all products in the store.</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-box-open fa-3x text-primary"></i>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <h2 class="text-primary">{{ $totalProducts }}</h2>
                            <a href="#" class="btn btn-outline-primary">View Products</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total Orders Card -->
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card shadow-lg bg-white rounded-lg">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Total Orders</h5>
                                <p class="card-text text-muted">View and manage customer orders.</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shopping-cart fa-3x text-success"></i>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <h2 class="text-success">{{ $totalOrders }}</h2>
                            <a href="#" class="btn btn-outline-success">View Orders</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total Users Card -->
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card shadow-lg bg-white rounded-lg">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Total Users</h5>
                                <p class="card-text text-muted">Manage registered users.</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users fa-3x text-warning"></i>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <h2 class="text-warning">{{ $totalUsers }}</h2>
                            <a href="#" class="btn btn-outline-warning">View Users</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total Revenue Card -->
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card shadow-lg bg-white rounded-lg">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Total Revenue</h5>
                                <p class="card-text text-muted">Total revenue generated.</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign fa-3x text-info"></i>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <h2 class="text-info">{{ number_format($totalRevenue, 1) }}</h2>
                            <a href="#" class="btn p-2">View Revenue</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Charts Row -->
        <div class="row">
            <!-- Sales Chart -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow-lg bg-white rounded-lg">
                    <div class="card-header bg-primary text-white">
                        Sales Overview
                    </div>
                    <div class="card-body">
                        <div id="salesChart"></div>
                    </div>
                </div>
            </div>
            <!-- User Growth Chart -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow-lg bg-white rounded-lg">
                    <div class="card-header bg-success text-white">
                        User Growth
                    </div>
                    <div class="card-body">
                        <div id="usersChart"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Recent Orders and Users -->
        <div class="row">
            <!-- Recent Orders -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow-lg bg-white rounded-lg">
                    <div class="card-header">
                        Recent Orders
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach ($recentOrders as $order)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Order #{{ $order->id }}</strong> <br>
                                        ${{ number_format($order->total, 2) }}
                                    </div>
                                    <span class="badge bg-primary">{{ $order->status }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Recent Users -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow-lg bg-white rounded-lg">
                    <div class="card-header">
                        Recent Users
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach ($recentUsers as $user)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $user->name }}</strong> <br>
                                        <small class="text-muted">{{ $user->email }}</small>
                                    </div>
                                    <span class="text-muted">{{ $user->created_at->diffForHumans() }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sales Chart
            var salesChartOptions = {
                chart: {
                    type: 'line',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Sales',
                    data: {!! json_encode($salesChartData['data']) !!}
                }],
                xaxis: {
                    categories: {!! json_encode($salesChartData['labels']) !!}
                },
                colors: ['#1e88e5'],
                stroke: {
                    width: 3
                },
                markers: {
                    size: 4,
                    colors: ['#1e88e5'],
                    strokeColors: '#fff',
                    strokeWidth: 2,
                    hover: {
                        size: 7
                    }
                }
            };

            var salesChart = new ApexCharts(document.getElementById('salesChart'), salesChartOptions);
            salesChart.render();

            // Users Chart
            var usersChartOptions = {
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'New Users',
                    data: {!! json_encode($usersChartData['data']) !!}
                }],
                xaxis: {
                    categories: {!! json_encode($usersChartData['labels']) !!}
                },
                colors: ['#4caf50']
            };

            var usersChart = new ApexCharts(document.getElementById('usersChart'), usersChartOptions);
            usersChart.render();
        });
    </script>
@endsection
