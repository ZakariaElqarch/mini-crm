<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['email', 'password', 'fullName', 'birthDate', 'phone', 'companyId', 'verified'];

    protected $hidden = ['password'];

    // Mutator for password hashing
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
