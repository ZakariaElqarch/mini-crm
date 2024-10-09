<?php

namespace App\Http\Controllers\Auth;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class EmployeeAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.employee_login'); // Create this Blade view
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::guard('employee')->attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return redirect()->route('employee.dashboard'); // Redirect to employee dashboard
    }

    public function logout(Request $request)
    {
        Auth::guard('employee')->logout();
        return redirect()->route('employee.login'); // Redirect to employee login
    }
}
