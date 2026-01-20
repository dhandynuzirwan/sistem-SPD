<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserFromEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $employees = \App\Models\Employee::all();

        foreach ($employees as $emp) {
            // Cek dulu apakah user ini sudah punya akun di tabel users agar tidak duplikat
            $exists = \App\Models\User::where('employee_id', $emp->id)->exists();

            if (!$exists) {
                \App\Models\User::create([
                    'employee_id' => $emp->id,
                    'username'    => $emp->username, // Mengambil langsung dari kolom username di employees
                    'password' => bcrypt($emp->password), // Mengambil langsung dari kolom password di employees
                    'name' => $emp->full_name,
                    'email' => $emp->username . '@example.com', // Contoh email,
                ]);
            }
        }
    }
}
