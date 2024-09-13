@extends('main')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-between">
            <div class="col-3">
                <h1 class="mb-4">All Products</h1>
            </div>
            @if ($user)
                @if ($user->type == 'admin')
                    <div class="col-3">
                        <a href="{{ route('product.create') }}" class="btn btn-primary">Add Product</a>
                    </div>
                @endif
            @endif
        </div>
        <!-- Search and Sort Form -->
        <form method="GET" action="{{ route('products.index') }}" class="mb-4">
            <div class="row justify-content-between">
                <div class="col-md-6 mb-2">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search products..."
                            value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn ms-2" type="submit">Search</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-2 text-right">
                    <div class="btn-group" role="group">
                        <a href="{{ route('products.index', array_merge(request()->input(), ['sort' => 'name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}"
                            class="btn sort-link">
                            Name @if (request('sort') === 'name')
                                ({{ request('direction') === 'asc' ? '↑' : '↓' }})
                            @endif
                        </a>
                        <a href="{{ route('products.index', array_merge(request()->input(), ['sort' => 'price', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}"
                            class="btn sort-link">
                            Price @if (request('sort') === 'price')
                                ({{ request('direction') === 'asc' ? '↑' : '↓' }})
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </form>

        <div class="row justify-content-around">
            @forelse($products as $product)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card shadow-lg rounded-5">
                        <img src="{{ $product->image }}" class="img-fluid" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            <p class="card-text"><strong>${{ $product->price }}</strong></p>
                            @if ($user)
                                @if ($user->type != 'admin')
                                    <a href="{{ route('product.show', $product->id) }}" class="btn ">View
                                        Details</a>
                                @else
                                    <div class="row justify-content-start">
                                        <div class="col-md-5 col-sm-8 mt-1">
                                            <a href="{{ route('product.edit', $product->id) }}"
                                                class="btn btn btn-primary py-1 px-4">Edit</a>
                                        </div>
                                        <div class="col-md-5 col-sm-8 mt-1">
                                            <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger py-1 px-4">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <a href="{{ route('product.show', $product->id) }}" class="btn ">View
                                    Details</a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">No products found.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $products->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>

@endsection
