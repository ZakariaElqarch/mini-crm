<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Exception; 

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Admin::query();

            // Search functionality
            if ($request->has('search') && !empty($request->input('search')['value'])) {
                $searchTerm = $request->input('search')['value'];
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('fullName', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('email', 'LIKE', "%{$searchTerm}%");
                });
            }

            return DataTables::of($query)
                ->addColumn('actions', function ($row) {
                    return $this->getActionButtons($row);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.admins.index');
    }

    public function create()
    {
        return view('admin.admins.create'); // Adjust the path according to your views
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateAdmin($request);

            Admin::create($validatedData);

            return redirect()->route('admins.index')->with('success', 'Admin created successfully.');
        } catch (Exception $e) {
            // Log the exception or show a generic error message
            return redirect()->back()->with('error', 'Failed to create admin: ' . $e->getMessage());
        }
    }

    public function show(Admin $admin)
    {
        try {
            return view('admin.admins.show', compact('admin')); // Adjust the path according to your views
        } catch (Exception $e) {
            // Handle other exceptions
            return redirect()->route('admins.index')->with('error', 'Failed to retrieve admin details: ' . $e->getMessage());
        }
    }

    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin')); // Adjust the path according to your views
    }

    public function update(Request $request, Admin $admin)
    {
        try {
            $validatedData = $this->validateAdmin($request);

            if ($this->hasChanges($admin, $validatedData)) {
                $admin->update($validatedData);
                return redirect()->route('admins.index')->with('success', 'Admin updated successfully.');
            }

            return redirect()->back()->with('info', 'No changes were made.');
        } catch (Exception $e) {
            // Handle any exceptions that may occur
            return redirect()->back()->with('error', 'Failed to update admin: ' . $e->getMessage());
        }
    }

    public function destroy(Admin $admin)
    {
        try {
            // Check if trying to delete the currently logged-in admin
            if ($admin->id === Auth::id()) {
                throw new Exception('You cannot delete your own account.');
            }

            // Check if this is the last admin account
            if (Admin::count() <= 1) {
                throw new Exception('Cannot delete the last admin account.');
            }

            $admin->delete();
            return redirect()->route('admins.index')->with('success', 'Admin deleted successfully.');
        } catch (Exception $e) {
            // Catch any exception and display an error message
            return redirect()->route('admins.index')->with('error', $e->getMessage());
        }
    }

    // Private Methods
    private function validateAdmin(Request $request)
    {
        return $request->validate([
            'email' => 'required|email|unique:admins,email,' . ($request->admin ? $request->admin->id : 'NULL'),
            'password' => 'required|min:8',
            'fullName' => 'required|string|max:255',
            'birthDate' => 'required|date|before:today',
            'phone' => 'nullable|string|max:15',
        ]);
    }

    private function hasChanges(Admin $admin, array $validatedData): bool
    {
        return (
            $admin->fullName !== $validatedData['fullName'] ||
            $admin->birthDate !== $validatedData['birthDate'] ||
            $admin->phone !== $validatedData['phone'] ||
            ($validatedData['password'] && !Hash::check($validatedData['password'], $admin->password))
        );
    }

    private function getActionButtons($row): string
    {
        $currentAdminId = Auth::id();
        $deleteButton = '';

        if ($row->id !== $currentAdminId) {
            $deleteButton = '
    <div class="menu-item px-3">
        <form action="' . route('admins.destroy', $row->id) . '" method="POST" style="display:inline;">
            ' . csrf_field() . method_field('DELETE') . '
            <button type="submit" class="btn btn-link btn-color-muted btn-active-color-primary me-5 mb-2 mx-5" onclick="return confirm(\'Are you sure you want to delete this admin?\')">Delete</button>
        </form>
    </div>';
        }

        return '
    <a class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
        <div class="menu-item px-3">
            <a href="' . route('admins.show', $row->id) . '" class="btn btn-link btn-color-muted btn-active-color-primary me-5 mb-2 mx-5">View</a>
        </div>
        ' . $deleteButton . '
    </div>';
    }
}
