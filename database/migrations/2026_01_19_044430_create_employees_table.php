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
//         - id
        // - full_name
        // - gender
        // - place_of_birth
        // - date_of_birth
        // - rank
        // - position
        // - username
        // - password
        // - role
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('full_name');
            $table->enum('gender', ['male', 'female']);
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('blood_type')->nullable();
            $table->string('position');
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('role', ['finance', 'employee', 'director']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
