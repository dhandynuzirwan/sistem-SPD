<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Employee extends Model
{
    protected $fillable = [
        'nik', 'full_name', 'gender', 'place_of_birth', 
        'date_of_birth', 'blood_type', 'position', 
        'username', 'password', 'role'
    ];

    // // Otomatis melakukan hashing password saat disimpan
    // protected function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = Hash::make($value);
    // }
}