<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin_login');
    }

    public function login(Request $request)
    {
        // Invalidate the current session
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in the admin
        if (!Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'email' => ['The provided credentials are incorrect.'],
            ])->withInput(); 
        }

        // Redirect to admin dashboard if successful
        return redirect()->route('admin.dashboard');
    }


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        // Invalidate the current session
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();
        return redirect()->route('admin.login'); // Redirect to admin login
    }
}
