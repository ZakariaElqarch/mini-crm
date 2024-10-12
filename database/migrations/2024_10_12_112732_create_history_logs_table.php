<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('history_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade'); // The admin who performed the action
            $table->foreignId('employee_id')->nullable()->constrained('employees')->onDelete('cascade'); // Optional employee reference
            $table->string('action'); // Action name, e.g., 'send_invitation', 'confirm_profile'
            $table->string('description'); // Human-readable description of the action
            $table->timestamps(); // Automatically includes created_at and updated_at
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_logs');
    }
};
