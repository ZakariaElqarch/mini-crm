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

class AdminEmployeeController extends Controller
{
    public function index(Request $request)
    {
        $companies = Company::all(); // Fetch all companies

        if ($request->ajax()) {
            $query = Employee::with(['company', 'invitation'])->select('employees.*');

            if ($request->has('search_name') && !empty($request->input('search_name'))) {
                $searchTerm = $request->input('search_name');
                $query->where('fullName', 'LIKE', "%{$searchTerm}%");
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

        return view('admin.employee.index', compact('companies'));
    }

    public function show(Employee $employee)
    {
        // Load the company relationship for the employee
        $company = $employee->company; // Access the company relationship directly

        // Return the employee info along with the associated company
        return view('admin.employee.show', [
            'employee' => $employee,
            'company' => $company, // Pass the company info
        ]);
    }


    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), $this->validationRules());

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $validatedData = $validator->validated();

            DB::transaction(function () use ($validatedData) {
                $employee = Employee::create([
                    'email' => $validatedData['email'],
                    'fullName' => $validatedData['fullName'],
                    'company_id' => $validatedData['company_id'],
                ]);

                $company = Company::find($validatedData['company_id']);
                $admin = auth()->user();

                if (!$company || !$admin) {
                    throw new Exception('Company or Admin not found');
                }

                $invitation = Invitation::create([
                    'admin_id' => $admin->id,
                    'employee_id' => $employee->id,
                    'token' => Str::random(40),
                    'status' => 'sent',
                ]);

                Mail::to($employee->email)->send(new EmployeeInviteMail($invitation, $company, $admin));

                HistoryLog::create([
                    'admin_id' => $admin->id,
                    'employee_id' => $employee->id,
                    'action' => 'send_invitation',
                    'description' => 'Admin "' . $admin->fullName . '" invited employee "' . $validatedData['fullName'] . '" with email "' . $validatedData['email'] . '".'
                ]);
            });

            return redirect()->back()->with('success', 'Invitation sent successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Failed to send invitation: ' . $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $employee = Employee::find($id);

            if (!$employee) {
                return redirect()->back()->with('error', 'Employee not found.');
            }

            Invitation::where('employee_id', $id)->delete();
            $employee->delete();

            return redirect()->back()->with('success', 'Employee deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete employee: ' . $e->getMessage());
        }
    }

    public function cancelInvitation($id)
    {
        try {
            $invitation = Invitation::find($id);

            if (!$invitation || $invitation->status === 'completed') {
                return redirect()->back()->with('error', 'Invitation cannot be canceled.');
            }

            $invitation->status = 'canceled';
            $invitation->save();

            return redirect()->back()->with('success', 'Invitation canceled successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to cancel invitation: ' . $e->getMessage());
        }
    }

    private function validationRules(): array
    {
        return [
            'email' => 'required|email|unique:employees,email',
            'fullName' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
        ];
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

        if ($row->invitation && ($row->invitation->status === 'sent' ||  $row->invitation->status == 'validated')) {
            $buttons .= '
            <div class="menu-item px-3">
                <form action="' . route('admin.invitations.cancel', $row->invitation->id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . method_field('POST') . '
                    <button type="submit" class="btn btn-link btn-color-muted btn-active-color-primary me-5 mb-2 mx-5" onclick="return confirm(\'Are you sure you want to cancel this invitation?\')">Cancel Invitation</button>
                </form>
            </div>';
        }

        $buttons .= '</div>';
        return $buttons;
    }
}
