<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\HistoryLog;
use App\Models\Invitation;
use Illuminate\Http\Request;


class InvitationController extends Controller
{
    /**
     * Validate an employee's invitation using the provided token.
     */
    public function validateInvitation(Request $request, $token)
    {
        // Retrieve the invitation by token
        $invitation = Invitation::where('token', $token)->first();

        // Handle invalid or already validated/canceled invitations
        if (!$invitation || in_array($invitation->status, ['validated', 'canceled'])) {
            return redirect()->route('home')->with('error', 'Invalid invitation link.');
        }

        // Update invitation status to 'validated'
        $invitation->status = 'validated';

        // Attempt to save the updated invitation
        if ($invitation->save()) {
            // Log the invitation validation in the history log
            HistoryLog::create([
                'admin_id' => $invitation->admin_id,
                'employee_id' => $invitation->employee_id,
                'action' => 'validate_invitation',
                'description' => '"' . $invitation->employee->fullName . '" validated the invitation.',
            ]);

            // Return view with success message
            return view('auth.validate_invitation', ['invitation' => $invitation])
                ->with('success', 'Invitation validated successfully.');
        } else {
            // Redirect to login with an error message if save fails
            return redirect()->route('login')->with('error', 'Failed to validate invitation. Please try again.');
        }
    }

    /**
     * Complete the employee profile associated with an invitation token.
     */
    public function completeProfile(Request $request, $token)
    {
        // Validate input data
        $validatedData = $request->validate([
            'address' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'password' => 'required|string|min:8|confirmed', // Confirm password input
        ]);

        // Retrieve the invitation using the token
        $invitation = Invitation::where('token', $token)->firstOrFail();

        // Retrieve the employee associated with the invitation
        $employee = Employee::findOrFail($invitation->employee_id);

        // Update the employee's profile with the validated data
        $employee->update([
            'address' => $validatedData['address'],
            'phone' => $validatedData['phoneNumber'],
            'birthDate' => $validatedData['date_of_birth'],
            'password' => $validatedData['password'], // Optionally hash the password
            'verified' => true, // Assuming the `verified` field exists in the Employee model
        ]);

        // Update the invitation status to 'completed'
        $invitation->status = 'completed';
        $invitation->save();

        // Log the profile confirmation in the history log
        HistoryLog::create([
            'admin_id' => $invitation->admin_id,
            'employee_id' => $employee->id,
            'action' => 'confirm_profile',
            'description' => '"' . $employee->fullName . '" confirmed their profile.',
        ]);

        // Redirect to employee login with a success message
        return redirect()->route('employee.login')->with('success', 'Profile completed successfully.');
    }
}
