<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Budget;
use Illuminate\Support\Facades\DB;

class LetterSeeder extends Seeder
{
    public function run(): void
    {
        // Mengambil ID dari data yang sudah di-seed sebelumnya
        $finance  = Employee::where('role', 'finance')->first();
        $director = Employee::where('role', 'director')->first();
        $employee = Employee::where('role', 'employee')->first();
        $budget   = Budget::first(); // Mengambil anggaran pertama

        if (!$finance || !$director || !$employee || !$budget) {
            return; // Berhenti jika data pendukung belum di-seed
        }

        DB::table('letters')->insert([
            [
                'letter_number'  => '001/AJP-SPD/I/2026',
                'finance_id'     => $finance->id,
                'director_id'    => $director->id,
                'employee_id'    => $employee->id,
                'budget_id'      => $budget->id,
                'cost_level'     => 'Tingkat B',
                'subject'        => 'Koordinasi Teknis Pengembangan Sistem Web',
                'transportation' => 'Pesawat Terbang',
                'departure_date' => '2026-01-25',
                'return_date'    => '2026-01-28',
                'follower'       => '1 Orang',
                'follower_name'  => 'Agus Santoso',
                'date_of_birth'  => '1992-03-15',
                'description'    => 'Kunjungan ke kantor cabang Jakarta untuk integrasi database.',
                'institution'    => 'PT. Mitra Solusi Jakarta',
                'status'         => 'approved', // Satu data disetujui untuk tes PDF
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'letter_number'  => '002/AJP-SPD/I/2026',
                'finance_id'     => $finance->id,
                'director_id'    => $director->id,
                'employee_id'    => $employee->id,
                'budget_id'      => $budget->id,
                'cost_level'     => 'Tingkat C',
                'subject'        => 'Audit Lapangan Proyek Sleman',
                'transportation' => 'Mobil Operasional',
                'departure_date' => '2026-02-01',
                'return_date'    => '2026-02-02',
                'follower'       => null,
                'follower_name'  => null,
                'date_of_birth'  => null,
                'description'    => 'Pengecekan progres pembangunan infrastruktur.',
                'institution'    => 'Dinas Pekerjaan Umum Sleman',
                'status'         => 'pending', // Satu data pending untuk tes tombol Approve
                'created_at'     => now(),
                'updated_at'     => now(),
            ]
        ]);
    }
}