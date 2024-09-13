@extends('main')

@section('content')
    <div class="container mx-auto py-8">
        <div class="bg-white shadow-md rounded my-6">
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
                            @foreach ($addresses as $address)
                                <div class="flex items-center">
                                    <input type="radio" id="address_{{ $address->id }}" name="address_id"
                                        value="{{ $address->id }}" required>
                                    <label for="address_{{ $address->id }}"
                                        class="ml-2 text-sm text-gray-700">{{ $address->address_line }},
                                        {{ $address->city }}, {{ $address->state }}</label>
                                </div>
                            @endforeach
                        </div>

                        <div class="mb-4">
                            <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment
                                Method</label>
                            <select id="payment_method" name="payment_method"
                                class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required>
                                <option value="">Select Payment Method</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="paypal">PayPal</option>
                                <!-- Add more options as needed -->
                            </select>
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
