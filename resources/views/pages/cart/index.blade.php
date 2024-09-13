<!-- resources/views/cart/index.blade.php -->
@extends('main')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Shopping Cart</h5>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($cartItems->isEmpty())
                            <div class="alert alert-info">
                                Your cart is empty. <a href="{{ route('products.index') }}" class="alert-link">Continue
                                    shopping</a>.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product</th>
                                            <th scope="col">Price</th>
                                            <th scope="col" style="width: 300px;">Quantity</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartItems as $cartItem)
                                            <tr>
                                                <td>
                                                    <div class="media">
                                                        <img src="{{ asset($cartItem->product->image) }}" class="mr-3"
                                                            alt="{{ $cartItem->product->name }}" style="width: 100px;">
                                                        <div class="media-body">
                                                            <h5 class="mt-0">{{ $cartItem->product->name }}</h5>
                                                            <p>{{ $cartItem->product->description }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>${{ number_format($cartItem->product->price, 2) }}</td>
                                                <td>
                                                    <form action="{{ route('cart.update', $cartItem->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="input-group">
                                                            <input type="number" name="quantity"
                                                                value="{{ $cartItem->quantity }}" class="form-control me-5"
                                                                min="1">
                                                            <div class="input-group-append">
                                                                <button type="submit"
                                                                    class="btn btn-outline-primary">Update</button>
                                                            </div>
                                                        </div>
                                                        @error('quantity')
                                                            <div class="text-danger mt-1">{{ $message }}</div>
                                                        @enderror
                                                    </form>
                                                </td>
                                                <td>
                                                    ${{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}
                                                </td>
                                                <td>
                                                    <form action="{{ route('cart.remove', $cartItem->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"><i
                                                                class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Total</strong></td>
                                            <td>${{ number_format($totalPrice, 2) }}</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Cart Summary</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-2">Total Items: {{ $cartItems->count() }}</p>
                        <h5>Total: <span class="text-danger"> {{ number_format($totalPrice, 2) }} </span></h5>
                        <hr>
                        <div class="row justify-content-between">
                            <div class="col-md-6 mt-2">
                                <a href="{{ route('products.index') }}" class="btn btn-secondary">Continue Shopping</a>
                            </div>
                            <div class="col-md-6 mt-2">
                                <a href="{{ route('checkout.index') }}" class="btn btn-success ml-2">Proceed to
                                    Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
