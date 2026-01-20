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
        // - lpd_id
        // - employee_id foreign key where  role = 'employee'
        // - letter_number
        // - destination
        // - date
        // - subject
        // - report_file

        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_id')->unique();
            $table->foreignId('employee_id')->constrained('employees');
            $table->foreignId('letter_number')->constrained('letters');
            $table->string('destination');
            $table->date('date');
            $table->string('subject');
            $table->string('report_file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
