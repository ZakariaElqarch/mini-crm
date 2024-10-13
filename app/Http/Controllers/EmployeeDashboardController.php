<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeDashboardController extends Controller
{
    public function showDashboard()
    {
        // Get the authenticated employee
        $employee = Auth::user(); // Assuming the employee is authenticated and is an instance of the Employee model

        // Get the employee's company
        $company = $employee->company;

        // Count all verified employees in that company
        $verifiedEmployeeCount = $company ? $company->employees()->where('verified', true)->count() : 0;

        return view('employee.dashboard', [
            'company' => $company ,
            'verifiedEmployeeCount' => $verifiedEmployeeCount,
        ]);
    }
}
