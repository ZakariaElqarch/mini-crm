<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['email', 'password', 'fullName', 'birthDate', 'phone'];

    protected $hidden = ['password'];

    // Mutator for password hashing
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function historyLog()
    {
        return $this->hasMany(HistoryLog::class); // Adjust this to your actual HistoryLog model
    }
}
