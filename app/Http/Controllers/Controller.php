<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $products = Product::all();
        return view('pages.dashboard.products', compact('products'));
    }
    public function showProfile()
    {
        return view('pages.profile');
    }
    public function showEditForm()
    {
        $user = Auth::user();
        return view('pages.profile.edit', compact('user'));
    }
    function updateProfile(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:male,female',
            'password' => 'nullable|string|min:8|confirmed',
            'password_confirmation' => 'required_with:password|string|min:8', // Ensure password confirmation is provided
            'current_password' => 'required|string',
        ]);

        // Get the current authenticated user
        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The provided password does not match our records.'],
            ]);
        }

        // Update user details
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->gender = $request->gender;

        // Update the password if provided
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Save the changes
        $user->save();

        // Redirect back with a success message
        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}