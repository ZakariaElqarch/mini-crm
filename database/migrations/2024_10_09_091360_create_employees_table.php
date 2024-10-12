<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password')->nullable(); // Optional; set when the employee confirms their profile
            $table->string('fullName')->nullable(); // Optional; can be set when the employee completes their profile
            $table->date('birthDate')->nullable(); // Optional; set during profile completion
            $table->string('phone')->nullable(); // Optional; set during profile completion
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->boolean('verified')->default(false); // Default to true since they are invited
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
