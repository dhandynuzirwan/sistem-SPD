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
    Schema::create('budgets', function (Blueprint $table) {
        $table->id();
        $table->string('id_budget')->unique();
        $table->string('detail');
        $table->integer('volume');
        $table->string('unit');
        $table->decimal('amount', 15, 2); // Untuk jumlah uang
        $table->decimal('total', 15, 2); // Untuk total anggaran
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
