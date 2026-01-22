<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data Finance
        $emp1 = Employee::create([
            'nik'            => '1234567890123456',
            'full_name'      => 'Ahmad Finance',
            'gender'         => 'male',
            'place_of_birth' => 'Yogyakarta',
            'date_of_birth'  => '1990-05-20',
            'blood_type'     => 'O',
            'position'       => 'Staff Keuangan',
            'username'       => 'finance',
            'password'       => Hash::make('password123'),
            'role'           => 'finance',
        ]);

        User::create([
            // 'name'        => $emp1->full_name,
            'username'    => $emp1->username,
            'password'    => $emp1->password, // Menggunakan password yang sama
            'employee_id' => $emp1->id,       // Menghubungkan ke ID Employee baru
        ]);

        // 2. Data Pegawai
        $emp2 = Employee::create([
            'nik'            => '1234567891234567',
            'full_name'      => 'Budi Pegawai',
            'gender'         => 'male',
            'place_of_birth' => 'Sleman',
            'date_of_birth'  => '1995-08-12',
            'blood_type'     => 'A',
            'position'       => 'Web Developer',
            'username'       => 'employee',
            'password'       => Hash::make('password123'),
            'role'           => 'employee',
        ]);

        User::create([
            // 'name'        => $emp2->full_name,
            'username'    => $emp2->username,
            'password'    => $emp2->password,
            'employee_id' => $emp2->id,
        ]);

        // 3. Data Direktur
        $emp3 = Employee::create([
            'nik'            => '1234567892345678',
            'full_name'      => 'Siti Direktur',
            'gender'         => 'female',
            'place_of_birth' => 'Bantul',
            'date_of_birth'  => '1985-01-30',
            'blood_type'     => 'B',
            'position'       => 'Direktur Utama',
            'username'       => 'director',
            'password'       => Hash::make('password123'),
            'role'           => 'director',
        ]);

        User::create([
            // 'name'        => $emp3->full_name,
            'username'    => $emp3->username,
            'password'    => $emp3->password,
            'employee_id' => $emp3->id,
        ]);
    }
}