<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Exception; // Import Exception for handling errors

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Company::withCount(['employees' => function ($query) {
                $query->where('verified', true);
            }]);

            // Search functionality
            if ($request->has('search_name') && !empty($request->input('search_name'))) {
                $searchName = $request->input('search_name');
                $query->where('name', 'LIKE', "%{$searchName}%");
            }

            return DataTables::of($query->get())
                ->addColumn('actions', function ($row) {
                    return $this->getActionButtons($row);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.companies.index');
    }

    public function create()
    {
        return view('admin.companies.create');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateCompany($request);
            Company::create($validatedData);
            return redirect()->route('admin.companies.index')->with('success', 'Company created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create company: ' . $e->getMessage());
        }
    }

    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        try {
            $validatedData = $this->validateCompany($request, $company->id); // Pass company ID for email validation

            if ($this->hasChanges($company, $validatedData)) {
                $company->update($validatedData);
                return redirect()->route('admin.companies.index')->with('success', 'Company updated successfully.');
            }

            return redirect()->back()->with('info', 'No changes were made.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update company: ' . $e->getMessage());
        }
    }

    public function destroy(Company $company)
    {
        try {
            if ($company->employees()->count() > 0) {
                return redirect()->route('admin.companies.index')->with('error', 'Cannot delete a company with employees.');
            }

            $company->delete();
            return redirect()->route('admin.companies.index')->with('success', 'Company deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.companies.index')->with('error', 'Failed to delete company: ' . $e->getMessage());
        }
    }

    // Private Methods
    private function validateCompany(Request $request, $companyId = null)
    {
        return $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:companies,email,' . $companyId, // Adjusted to use the correct table name
            'address' => 'required|max:255',
            'phone' => 'required|numeric',
            'description' => 'nullable|max:500',
        ]);
    }

    private function hasChanges(Company $company, array $validatedData): bool
    {
        return (
            $company->name !== $validatedData['name'] ||
            $company->address !== $validatedData['address'] ||
            $company->phone !== $validatedData['phone'] ||
            $company->description !== $validatedData['description']
        );
    }

    private function getActionButtons($row): string
    {
        return '
            <a class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                <div class="menu-item px-3">
                    <a href="' . route('admin.companies.show', $row->id) . '" class="btn btn-link btn-color-muted btn-active-color-primary me-5 mb-2 mx-5">View</a>
                </div>
                <div class="menu-item px-3">
                    <a href="' . route('admin.companies.edit', $row->id) . '" class="btn btn-link btn-color-muted btn-active-color-primary me-5 mb-2 mx-5">Edit</a>
                </div>
                <div class="menu-item px-3">
                    <form action="' . route('admin.companies.destroy', $row->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-link btn-color-muted btn-active-color-primary me-5 mb-2 mx-5" onclick="return confirm(\'Are you sure?\')">Delete</button>
                    </form>
                </div>
            </div>';
    }
}
