<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\HistoryLog;
use App\Models\Invitation;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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
        //
    }


    public function validateInvitation(Request $request, $token)
    {
        // Find the invitation by token
        $invitation = Invitation::where('token', $token)->first();

        if (!$invitation) {
            return redirect()->route('login')->with('error', 'Invalid invitation link.');
        }
        if ($invitation->status === 'validated') {
            return redirect()->route('home')->with('error', 'Invalid invitation link.');
        }
        if ($invitation->status === 'canceled') {
            return redirect()->route('home')->with('error', 'Invalid invitation link.');
        }
        // Update the invitation status to validated
        $invitation->status = 'validated';

        // Check if the save operation is successful
        if ($invitation->save()) {
            // Log the action in history
            HistoryLog::create([
                'admin_id' => $invitation->admin_id,
                'employee_id' => $invitation->employee_id,
                'action' => 'validate_invitation',
                'description' => '"' . $invitation->employee->fullName . '" validated the invitation.',
            ]);

            // Optionally, you can add a success message here
            return view('auth.validate_invitation', ['invitation' => $invitation])
                ->with('success', 'Invitation validated successfully.');
        } else {
            // Handle the case where saving the invitation fails
            return redirect()->route('login')->with('error', 'Failed to validate invitation. Please try again.');
        }
    }


    public function completeProfile(Request $request, $token)
    {
        // Validate the input
        $validatedData = $request->validate([
            'address' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'password' => 'required|string|min:8|confirmed', // Ensure the password is confirmed
        ]);

        // Find the invitation
        $invitation = Invitation::where('token', $token)->firstOrFail();

        // Find the employee
        $employee = Employee::findOrFail($invitation->employee_id);

        // Update the employee's profile
        $employee->update([
            'address' => $validatedData['address'],
            'phoneNumber' => $validatedData['phoneNumber'],
            'date_of_birth' => $validatedData['date_of_birth'],
            'password' => $validatedData['password'], // Hash the password before saving
            'verified' => true, // Assuming this field exists in your Employee model
        ]);

        // Update the invitation status to completed
        $invitation->status = 'completed';
        $invitation->save();

        // Log the action in history
        HistoryLog::create([
            'admin_id' => $invitation->admin_id,
            'employee_id' => $employee->id,
            'action' => 'confirm_profile',
            'description' => '"' . $employee->fullName . '" confirmed their profile.',
        ]);

        return redirect()->route('employee.login')->with('success', 'Profile completed successfully.');
    }
}
