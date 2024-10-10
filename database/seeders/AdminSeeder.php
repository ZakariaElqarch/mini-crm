<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin; 
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Admin::count() === 0) {
            Admin::create([
                'email' => 'admin@example.com', 
                'password' => 'password', 
                'fullName' => 'Admin User', 
                'birthDate' => '1990-01-01',
                'phone' => '1234567890', 
            ]);
        }
    }
}
