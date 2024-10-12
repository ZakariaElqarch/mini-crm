<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryLog extends Model
{
    use HasFactory;

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'admin_id',
        'employee_id',
        'action',
        'description',
    ];

    /**
     * Get the admin associated with the history log.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Get the employee associated with the history log.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
