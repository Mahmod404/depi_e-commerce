<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Ensure user is authenticated
        if (!$user) {
            return redirect()->route('login')->with('warning', 'Please log in to proceed with checkout.');
        }

        // Fetch user's cart items with associated products
        $cartItems = $user->cartItems;

        // Check if user has any addresses
        $addresses = $user->addresses;

        if ($addresses->isEmpty()) {
            // Redirect to add address if user has no addresses
            return redirect()->route('address.create')->with('warning', 'Please add an address to proceed with checkout.');
        }

        return view('pages.checkout.index', compact('user', 'cartItems', 'addresses'));
    }

    public function process(Request $request)
    {
        dd(request()->all());
        // $request->validate([
        //     'address_id' => 'required|exists:addresses,id',
        //     'total_amount' => 'required|numeric|min:0',
        // ]);
        // $user = auth()->user();
        // // dd([$user, $request->all()]);

        // $cartItems = $user->cartItems;

        // // dd([$user, $request->all(), $cartItems]);

        // if ($cartItems->isEmpty()) {
        //     return redirect()->route('cart.index')->with('warning', 'Your cart is empty.');
        // }

        // // Calculate total amount
        // $calculatedTotalAmount = $cartItems->sum(function ($cartItem) {
        //     return $cartItem->product->price * $cartItem->quantity;
        // });

        // if ($request->total_amount != $calculatedTotalAmount) {
        //     return redirect()->route('checkout.index')->with('warning', 'Total amount mismatch.');
        // }

        // $order = new Order();
        // $order->user_id = $user->id;
        // $order->address_id = $request->address_id;
        // $order->total_amount = $calculatedTotalAmount;
        // $order->save();

        // // Create order items
        // foreach ($cartItems as $cartItem) {
        //     OrderItem::create([
        //         'order_id' => $order->id,
        //         'product_id' => $cartItem->product_id,
        //         'quantity' => $cartItem->quantity,
        //         'price' => $cartItem->product->price,
        //     ]);
        // }

        // // Clear user's cart after checkout
        // Cart::where('user_id', $user->id)->delete();

        // return redirect()->route('order.show', $order->id)->with('success', 'Order placed successfully!');
    }
}