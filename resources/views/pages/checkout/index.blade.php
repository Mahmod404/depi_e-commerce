@extends('main')
@section('content')
    <div class="container mx-auto py-8">
        <div class="bg-white shadow-lg rounded-4 border-1 border-primary opacity-75 my-6">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-6">Checkout</h2>

                @if ($addresses->isEmpty())
                    <p class="text-red-500">You don't have any addresses. Please <a href="{{ route('address.create') }}"
                            class="text-blue-500">add an address</a> to proceed with checkout.</p>
                @else
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Select Address</label>
                            <ul class="list-group">
                                @foreach ($addresses as $address)
                                    <li class="list-group-item w-50 mb-2">
                                        <input type="radio" id="address_{{ $address->id }}" name="address_id"
                                            value="{{ $address->id }}" class="me-1" required>
                                        <label for="address_{{ $address->id }}"
                                            class="ml-2 text-sm text-gray-700">{{ $address->address }},
                                            {{ $address->city }}.</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>


                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Cart Items</label>
                            <ul class="list-group list-group-flush pl-5">
                                @foreach ($cartItems as $cartItem)
                                    <li class="list-group-item">{{ $cartItem->product->name }} - Quantity:
                                        {{ $cartItem->quantity }} - Price:
                                        {{ $cartItem->product->price }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Total Amount</label>
                            <p class="text-lg font-semibold">
                                {{ $total_amount = $cartItems->sum(function ($cartItem) {return $cartItem->product->price * $cartItem->quantity;}) }}
                                <input type="hidden" name="total_amount" value="{{ $total_amount }}">
                            </p>
                        </div>

                        <div class="text-right">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Place
                                Order</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
