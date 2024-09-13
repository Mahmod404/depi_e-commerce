<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    }
    public function create()
    {
        return view('pages.address.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id', // Ensure user_id exists in users table
        ]);

        // Create the address
        Address::create([
            'user_id' => $request->user_id,
            'address' => $request->address,
            'city' => $request->city,
        ]);

        // Redirect back with a success message
        return redirect()->route('profile')->with('success', 'Address added successfully.');
    }
    public function show(Address $address)
    {
        //
    }
    public function edit($id)
    {
        $address = Address::findOrFail($id);
        return view('pages.address.edit', compact('address'));
    }
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);

        // Find the address and update its details
        $address = Address::findOrFail($id);
        $address->update([
            'address' => $request->address,
            'city' => $request->city,
        ]);

        // Redirect back with a success message
        return redirect()->route('profile')->with('success', 'Address updated successfully.');
    }
    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();

        return redirect()->route('profile')->with('success', 'Product deleted successfully.');
    }
}