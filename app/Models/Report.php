<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'report_id',
        'employee_id',
        'letter_number',
        'destination',
        'date',
        'subject',
        'report_file',
    ];

    public function letter()
    {
        return $this->belongsTo(Letter::class, 'letter_number');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
