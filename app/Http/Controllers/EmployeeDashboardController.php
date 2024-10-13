<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeDashboardController extends Controller
{
    public function showDashboard()
    {
        // Get total count of verified employees across all companies
        $totalVerifiedEmployees = Employee::where('verified', true)->count();

        // Get total count of unverified employees across all companies
        $totalUnVerifiedEmployees = Employee::where('verified', false)->count();

      
        // Get total count of companies
        $totalCompanies = Company::count();

       

        // Get employee count per company using model relationships
        $employeeCountsByCompany = Company::withCount(['employees as verified_count' => function ($query) {
            $query->where('verified', true);  // Count only verified employees
        }])->get();

        // Prepare data for the chart
        $labels = [];
        $dataCounts = [];

        foreach ($employeeCountsByCompany as $company) {
            $labels[] = $company->name;  // Assuming the Company model has a 'name' attribute
            $dataCounts[] = $company->verified_count;  // Accessing the verified employee count
        }

        return view('employee.dashboard', [
        ]);
    }
}
