<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Company;
use App\Models\Employee;
use App\Models\HistoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        // Get total count of verified employees across all companies
        $totalVerifiedEmployees = Employee::where('verified', true)->count();

        // Get total count of unverified employees across all companies
        $totalUnVerifiedEmployees = Employee::where('verified', false)->count();

        // Get total count of admins across all companies
        $totalAdmins = Admin::count();

        // Get total count of companies
        $totalCompanies = Company::count();

        // Get the latest history logs with associated admin and employee data
        $historyLogs = HistoryLog::with(['admin', 'employee'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

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

        return view('admin.dashboard', [
            'totalVerifiedEmployees' => $totalVerifiedEmployees,
            'totalUnVerifiedEmployees' => $totalUnVerifiedEmployees,
            'totalAdmins' => $totalAdmins,
            'totalCompanies' => $totalCompanies,
            'historyLogs' => $historyLogs,
            'labels' => $labels,
            'dataCounts' => $dataCounts,
        ]);
    }
}
