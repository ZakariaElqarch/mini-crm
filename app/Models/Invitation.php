<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'employee_id',
        'admin_id',
        'token',
        'status',
    ];

    /**
     * Get the employee associated with the invitation.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Get the admin who sent the invitation.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
