<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function show()
    {
        // Get the authenticated employee's company_id
        $authEmployee = Auth::guard('employee')->user();
        $companyId = $authEmployee->company_id;
        // Retrieve the company data for the authenticated employee
        $company = Company::findOrFail($companyId); // Assuming you have a Company model and table
        $verifiedEmployees = $company->employees()->where('verified', true)->get();

        // Pass the company data to the view
        return view('employee.Company.show', compact('company','verifiedEmployees'));
    }
}
