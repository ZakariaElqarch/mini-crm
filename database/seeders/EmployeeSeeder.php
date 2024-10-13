<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Company;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Retrieve the first company as an example (you can change this logic to pick a specific company)
        $company = Company::first();

        // Seed one employee manually
        Employee::create([
            'email' => 'john.doe@example.com',
            'password' => 'password123', 
            'fullName' => 'John Doe',
            'birthDate' => '1990-01-01',
            'phone' => '1234567890',
            'company_id' => $company->id, 
            'verified' => true, 
        ]);
    }
}
