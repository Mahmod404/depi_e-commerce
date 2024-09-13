<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;
    protected $redirectTo = '/';

    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    public function redirectPath()
    {
        // Get the authenticated user
        $user = Auth::user();
        // Check if the user is not admin
        if ($user->type != 'admin') {
            return '/';
        }
        // For admin users
        return '/admin/dashboard';
    }
}