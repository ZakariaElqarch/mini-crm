<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class EmployeeProfileController extends Controller
{
    public function show()
    {
        try {
            $employee = Auth::guard('employee')->user();
            $company = $employee->company;
            return view('employee.profile.show', compact('employee',"company"));
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Failed to retrieve employee profile: ' . $e->getMessage()]);
        }
    }

    public function edit()
    {
        try {
            $employee = Auth::guard('employee')->user();
            return view('employee.profile.edit', compact('employee'));
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Failed to retrieve employee profile for editing: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {
            $employee = Auth::guard('employee')->user();

            $validator = Validator::make($request->all(), $this->validationRules($employee->id));

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $validatedData = $validator->validated();

            if ($this->hasChanges($employee, $validatedData)) {
                $employee->fill($validatedData);
                $employee->save();
                return redirect()->route('employee.profile.show')->with('success', 'Profile updated successfully.');
            }

            return redirect()->back()->with('info', 'No changes were made.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Failed to update profile: ' . $e->getMessage()]);
        }
    }

    private function validationRules($employeeId = null)
    {
        return [
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email,' . $employeeId,
            'phone' => 'nullable|string|max:15',
            'birthDate' => 'nullable|date|before:today',
            // Add more validation rules as necessary
        ];
    }

    private function hasChanges(Employee $employee, array $validatedData): bool
    {
        return (
            $employee->fullName !== $validatedData['fullName'] ||
            $employee->email !== $validatedData['email'] ||
            $employee->phone !== ($validatedData['phone'] ?? $employee->phone) ||
            $employee->birthDate !== ($validatedData['birthDate'] ?? $employee->birthDate)
            // Add more fields as necessary
        );
    }
}
