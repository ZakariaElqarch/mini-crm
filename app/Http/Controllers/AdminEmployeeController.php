<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use App\Mail\EmployeeInviteMail;
use App\Models\Company;
use App\Models\Employee;
use App\Models\HistoryLog;
use App\Models\Invitation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        // Fetch all companies to pass to the view
        $companies = Company::all(); // Fetch all companies

        if ($request->ajax()) {
            $query = Employee::with(['company', 'invitation'])->select('employees.*'); // Include company and invitation data

            // Search functionality
            if ($request->has('search_name') && !empty($request->input('search_name'))) {
                $searchTerm = $request->input('search_name');
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('fullName', 'LIKE', "%{$searchTerm}%");
                });
            }

            return DataTables::of($query)
                ->addColumn('company_name', function ($row) {
                    return $row->company ? $row->company->name : 'No Company'; // Get company name
                })
                ->addColumn('invitation_status', function ($row) {
                    return $row->invitation ? $row->invitation->status : 'No Invitation'; // Display the invitation status
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

        return view('admin.employee.index', compact('companies')); // Pass companies to the view
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'email' => 'required|email|unique:employees,email', // Ensure uniqueness in employees
            'fullName' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
        ]);

        DB::transaction(function () use ($validatedData) {
            // Create the employee
            $employee = Employee::create([
                'email' => $validatedData['email'],
                'fullName' => $validatedData['fullName'],
                'company_id' => $validatedData['company_id'],
            ]);

            // Retrieve the company and admin
            $company = Company::find($validatedData['company_id']);
            $admin = auth()->user(); // Get the currently authenticated admin

            if (!$company || !$admin) {
                // Handle the error, either return a response or throw an exception
                throw new \Exception('Company or Admin not found');
            }

            // Create the invitation
            $invitation = Invitation::create([
                'admin_id' => $admin->id,
                'employee_id' => $employee->id,
                'token' => Str::random(40),
                'status' => 'sent',
            ]);

            try {
                // Pass the company and admin information to the mail
                Mail::to($employee->email)->send(new EmployeeInviteMail($invitation, $company, $admin));
            } catch (\Exception $e) {
                Log::error('Failed to send invitation email: ' . $e->getMessage());
                throw $e; // Throw the exception to rollback
            }

            // Log the action in history
            HistoryLog::create([
                'admin_id' => $admin->id,
                'employee_id' => $employee->id,
                'action' => 'send_invitation',
                'description' => 'Admin "' . $admin->fullName . '" invited employee "' . $validatedData['fullName'] . '" with email "' . $validatedData['email'] . '".'
            ]);
        });

        return redirect()->back()->with('success', 'Invitation sent successfully.');
    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the employee
        $employee = Employee::find($id);

        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found.');
        }

        // Delete the associated invitation
        Invitation::where('employee_id', $id)->delete();

        // Delete the employee
        $employee->delete();

        return redirect()->back()->with('success', 'Employee deleted successfully.');
    }

    /**
     * Cancel the specified invitation.
     */
    public function cancelInvitation($id)
    {
        // Find the invitation
        $invitation = Invitation::find($id);

        if (!$invitation || $invitation->status !== 'sent') {
            return redirect()->back()->with('error', 'Invitation cannot be canceled.');
        }

        // Update the invitation status to canceled
        $invitation->status = 'canceled';
        $invitation->save();

        return redirect()->back()->with('success', 'Invitation canceled successfully.');
    }


    private function getActionButtons($row): string
    {
        $buttons = '
        <a class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
            <div class="menu-item px-3">
                <a href="' . route('employee.show', $row->id) . '" class="btn btn-link btn-color-muted btn-active-color-primary me-5 mb-2 mx-5">View</a>
            </div>
            <div class="menu-item px-3">
                <form action="' . route('employee.destroy', $row->id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . method_field('DELETE') . '
                    <button type="submit" class="btn btn-link btn-color-muted btn-active-color-primary me-5 mb-2 mx-5" onclick="return confirm(\'Are you sure you want to delete this employee?\')">Delete</button>
                </form>
            </div>';

        // Add cancel invitation option if an invitation exists and is sent
        if ($row->invitation && $row->invitation->status === 'sent') {
            $buttons .= '
            <div class="menu-item px-3">
                <form action="' . route('admin.invitations.cancel', $row->invitation->id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . method_field('POST') . '
                    <button type="submit" class="btn btn-link btn-color-muted btn-active-color-primary me-5 mb-2 mx-5" onclick="return confirm(\'Are you sure you want to cancel this invitation?\')">Cancel Invitation</button>
                </form>
            </div>';
        }

        $buttons .= '</div>'; // Close the menu div
        return $buttons;
    }
}
