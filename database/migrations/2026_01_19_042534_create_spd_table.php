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
        // - letter_number
        // - finance_id
        // - employee_id
        // - director_id
        // - budget_id
        // - cost_level
        // - subject
        // - transportation
        // - departure_date
        // - return_date
        // - follower
        // - follower_name
        // - date_of_birth
        // - description
        // - institution
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->string('letter_number')->unique();
            $table->foreignId('finance_id')->constrained('employees');
            $table->foreignId('director_id')->constrained('employees');
            $table->foreignId('employee_id')->constrained('employees');
            $table->foreignId('budget_id')->constrained('budgets');
            $table->string('cost_level');
            $table->string('subject');
            $table->string('transportation');
            $table->date('departure_date');
            $table->date('return_date');
            $table->string('follower')->nullable();
            $table->text('follower_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('description')->nullable();
            $table->string('institution');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};
