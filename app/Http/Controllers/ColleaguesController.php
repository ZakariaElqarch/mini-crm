<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Company;
use App\Models\Employee;
use App\Models\HistoryLog;
use App\Models\Invitation;
use App\Mail\EmployeeInviteMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Exception;

class ColleaguesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the authenticated employee's company_id
        $authEmployee = Auth::guard('employee')->user();
        $companyId = $authEmployee->company_id;

        if ($request->ajax()) {
            // Query to get employees with their related company, filtering by the authenticated employee's company_id
            $query = Employee::with(['company'])
                ->where('company_id', $companyId) // Only employees from the same company
                ->select('employees.*');

            // Check for a search term (e.g., employee full name)
            if ($request->has('search_name') && !empty($request->input('search_name'))) {
                $searchTerm = $request->input('search_name');
                $query->where('fullName', 'LIKE', "%{$searchTerm}%");
            }

            // Return the data in DataTables format
            return DataTables::of($query)
                ->addColumn('company_name', function ($row) {
                    return $row->company ? $row->company->name : 'No Company'; // Get company name
                })
                ->addColumn('verified', function ($row) {
                    // Return HTML for a checkmark or cross based on verification status
                    return $row->verified
                        ? '<i class="ki-duotone ki-check-square fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>' // Green check icon
                        : '<i class="ki-duotone ki-cross-square fs-1 text-danger"><span class="path1"></span><span class="path2"></span></i>'; // Red cross icon
                })
                ->addColumn('actions', function ($row) {
                    return $this->getActionButtons($row); // Assuming you have a method to get action buttons
                })
                ->rawColumns(['actions', 'verified']) // Allow HTML in the verified column
                ->make(true);
        }

        // Return the view
        return view('employee.colleagues.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get the authenticated employee's company_id
        $authEmployee = Auth::guard('employee')->user();
        $companyId = $authEmployee->company_id;

        // Find the employee (colleague) by the given id and make sure they belong to the same company
        $employee = Employee::with('company')->where('company_id', $companyId)->findOrFail($id);

        // Pass the employee and their company data to the view
        $company = $employee->company; // Get the company associated with the employee

        return view('employee.colleagues.show', compact('employee', 'company'));
    }





    private function getActionButtons($row): string
    {
        $buttons = '
        <a class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
            <div class="menu-item px-3">
                <a href="' . route('employee.colleagues.show', $row->id) . '" class="btn btn-link btn-color-muted btn-active-color-primary me-5 mb-2 mx-5">View</a>
            </div>
        </div>';
        return $buttons;
    }
}
