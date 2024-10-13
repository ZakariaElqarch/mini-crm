<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class AdminProfileController extends Controller
{
    public function show()
    {
        try {
            $admin = Auth::guard('admin')->user();
            return view('admin.profile.show', compact('admin'));
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Failed to retrieve admin profile: ' . $e->getMessage()]);
        }
    }

    public function edit()
    {
        try {
            $admin = Auth::guard('admin')->user();
            return view('admin.profile.edit', compact('admin'));
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Failed to retrieve admin profile for editing: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {
            $admin = Auth::guard('admin')->user();

            $validator = Validator::make($request->all(), $this->validationRules($admin->id));

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $validatedData = $validator->validated();

            if ($this->hasChanges($admin, $validatedData)) {
                $admin->fill($validatedData);
                $admin->save();
                return redirect()->route('admin.profile.show')->with('success', 'Profile updated successfully.');
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
        ];
    }

    private function hasChanges(Admin $admin, array $validatedData): bool
    {
        return (
            $admin->fullName !== $validatedData['fullName'] ||
            $admin->email !== $validatedData['email'] ||
            $admin->phone !== ($validatedData['phone'] ?? $admin->phone) ||
            $admin->birthDate !== ($validatedData['birthDate'] ?? $admin->birthDate)
        );
    }
}
