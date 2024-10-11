<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample data for the companies table
        $companies = [
            [
                'name' => 'Company A',
                'email' => 'contact@companya.com',
                'description' => 'Description for Company A',
                'address' => '123 Main St, City A',
                'phone' => '1234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Company B',
                'email' => 'contact@companyb.com',
                'description' => 'Description for Company B',
                'address' => '456 Main St, City B',
                'phone' => '9876543210',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Company C',
                'email' => 'contact@companyc.com',
                'description' => 'Description for Company C',
                'address' => '789 Main St, City C',
                'phone' => '5555555555',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Company D',
                'email' => 'contact@companyd.com',
                'description' => 'Description for Company D',
                'address' => '321 North St, City D',
                'phone' => '1231231234',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Company E',
                'email' => 'contact@companye.com',
                'description' => 'Description for Company E',
                'address' => '654 South St, City E',
                'phone' => '4564564567',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Company F',
                'email' => 'contact@companyf.com',
                'description' => 'Description for Company F',
                'address' => '789 West St, City F',
                'phone' => '7897897890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Company G',
                'email' => 'contact@companyg.com',
                'description' => 'Description for Company G',
                'address' => '135 East St, City G',
                'phone' => '3213213210',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Company H',
                'email' => 'contact@companyh.com',
                'description' => 'Description for Company H',
                'address' => '246 Center St, City H',
                'phone' => '6546546543',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Company I',
                'email' => 'contact@companyi.com',
                'description' => 'Description for Company I',
                'address' => '369 Avenue St, City I',
                'phone' => '9879879876',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Company J',
                'email' => 'contact@companyj.com',
                'description' => 'Description for Company J',
                'address' => '147 Boulevard St, City J',
                'phone' => '2582582580',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Company K',
                'email' => 'contact@companyk.com',
                'description' => 'Description for Company K',
                'address' => '369 Parkway St, City K',
                'phone' => '9639639630',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];


        // Insert sample data into the companies table
        DB::table('companies')->insert($companies);
    }
}
