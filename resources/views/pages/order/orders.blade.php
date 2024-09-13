@extends('main')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-between">
            <div class="col-3">
                <h1 class="mb-4">All Orders</h1>
            </div>
        </div>

        <div class="row">
            @forelse($orders as $order)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $order->total_amount }}</h5>
                            <p class="card-text">{{ $order->status }}</p>
                            <p class="card-text"><strong>{{ $order->phone }}</strong></p>
                            <p class="card-text"><strong>{{ $order->city }}</strong></p>
                            <p class="card-text"><strong>{{ $order->address }}</strong></p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">No orders found.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $orders->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>

@endsection
