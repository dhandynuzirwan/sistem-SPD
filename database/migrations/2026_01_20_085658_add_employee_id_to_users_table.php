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
        // Gunakan Schema::table untuk MENGUBAH tabel yang sudah ada
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom bawaan yang tidak diperlukan jika ada (opsional)
            // $table->dropColumn('name'); 
            // $table->dropColumn('email');

            $table->foreignId('employee_id')->nullable()->after('id')->constrained('employees')->onDelete('cascade');
            $table->string('username')->unique()->after('employee_id');
            
            // password biasanya sudah ada, jika belum ada baru tambahkan:
            // $table->string('password'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
