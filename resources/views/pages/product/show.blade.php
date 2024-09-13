@extends('main')

@section('content')
    <div class="container product-details">
        <div class="row justify-content-around">
            <div class="col-sm-4">
                <img src="{{ asset($product->image) }}" class="w-100">
            </div>
            <div class="col-sm-4 mt-5 border-start py-5">
                <h2 class="text-uppercase text-decoration-line-through">{{ $product->name }}</h2>
                <p class="text-uppercase"><strong class="me-2 text-uppercase">Category:</strong> {{ $product->category->name }}</p>
                <p class="text-uppercase"><strong class="me-2 text-uppercase">Brand:</strong> {{ $product->brand->name }}</p>
                <p class="text-uppercase"><strong class="me-2 text-uppercase">Description:</strong> {{ $product->description }}</p>
                <p class="text-uppercase"><strong class="me-2 text-uppercase">Price:</strong>{{ number_format($product->price, 2) }}</p>
                @if (Auth::user())
                    @if (Auth::user()->type == 'admin')
                        <div class="row justify-content-start">
                            <div class="col-md-5 col-sm-8 mt-1">
                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn btn-primary py-1">Edit</a>
                            </div>
                            <div class="col-md-5 col-sm-8 mt-1">
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger py-1">Delete</button>
                                </form>
                            </div>
                        </div>
                    @else
                        @if ($product->availability == 'true')
                            <button class="btn btn-primary add-to-cart" data-id="{{ $product->id }}">Add to Cart</button>
                        @else
                            <button class="btn btn-add-to-cart" disabled>Add to Cart</button>
                            <div class="mt-3 text-danger">
                                <h5>This Product Is Not available.</h5>
                            </div>
                        @endif
                    @endif
                @else
                    <a class="btn btn-primary add-to-cart" href="{{ route('cart.index') }}" data-id="{{ $product->id }}">Add to Cart</a>
                @endif
            </div>
        </div>
    </div>
    <!-- Modal for Add to Cart Confirmation -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Item Added to Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Would you like to continue shopping or go to the cart to checkout?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continue Shopping</button>
                    <a href="{{ route('cart.index') }}" class="btn btn-primary">Go to Cart</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.dataset.id;

                    fetch("{{ route('cart.add') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                product_id: productId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const cartModal = new bootstrap.Modal(document.getElementById(
                                    'cartModal'));
                                cartModal.show();
                            } else {
                                alert('Something went wrong. Please try again.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred. Please try again.');
                        });
                });
            });
        });
    </script>
@endsection
