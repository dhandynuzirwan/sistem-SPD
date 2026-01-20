<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Budget;

// Schema::create('letters', function (Blueprint $table) {
//             $table->id();
//             $table->string('letter_number')->unique();
//             $table->foreignId('finance_id')->constrained('employees');
//             $table->foreignId('director_id')->constrained('employees');
//             $table->foreignId('employee_id')->constrained('employees');
//             $table->foreignId('budget_id')->constrained('budgets');
//             $table->string('cost_level');
//             $table->string('subject');
//             $table->string('transportation');
//             $table->date('departure_date');
//             $table->date('return_date');
//             $table->string('follower')->nullable();
//             $table->text('follower_name')->nullable();
//             $table->date('date_of_birth')->nullable();
//             $table->text('description')->nullable();
//             $table->string('institution');
//             $table->timestamps();
//         });

class Letter extends Model
{
    protected $fillable = [
        'letter_number', 'finance_id', 'director_id', 
        'employee_id', 'budget_id', 'cost_level', 
        'subject', 'transportation', 'departure_date', 
        'return_date', 'follower', 'follower_name', 
        'date_of_birth', 'description', 'institution', 'status'
    ];

    public function finance()
    {
        return $this->belongsTo(Employee::class, 'finance_id');
    }
    public function director()
    {
        return $this->belongsTo(Employee::class, 'director_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function budget()
    {
        return $this->belongsTo(Budget::class, 'budget_id');
    }
}
