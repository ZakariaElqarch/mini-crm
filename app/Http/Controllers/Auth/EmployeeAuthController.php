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
        // Invalidate the current session
        $request->session()->invalidate();
    
        // Regenerate the CSRF token
        $request->session()->regenerateToken();
    
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Find the employee by email
        $employee = Employee::where('email', $request->email)->first();
    
        // Check if the employee exists and if they are verified
        if ($employee && !$employee->verified) {
            return back()->withErrors([
                'email' => ['Your account is not verified. Please check your email for verification.'],
            ])->withInput();  // Add withInput() to return old input values
        }
    
        // Attempt to log in the employee
        if (!Auth::guard('employee')->attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'email' => ['The provided credentials are incorrect.'],
            ])->withInput();  // Add withInput() to return old input values
        }
    
        // Redirect to employee dashboard if successful
        return redirect()->route('employee.dashboard');
    }
    


    public function logout(Request $request)
    {
        Auth::guard('employee')->logout();

        // Invalidate the current session
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        return redirect()->route('employee.login')->with('success', 'You have been successfully logged out.');
    }
}
