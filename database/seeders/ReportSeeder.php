<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Letter;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil data pegawai (Budi Pegawai)
        $employee = Employee::where('username', 'employee')->first();
        
        // Ambil data surat yang sudah disetujui
        $letter = Letter::where('status', 'approved')->first();

        if (!$employee || !$letter) {
            return; // Berhenti jika data pendukung tidak ditemukan
        }

        DB::table('reports')->insert([
            [
                'report_id'     => 'LPD-2026-001',
                'employee_id'   => $employee->id,
                // Catatan: Di skema Anda, kolom FK bernama 'letter_number' 
                // tapi merujuk ke ID tabel letters.
                'letter_number' => $letter->id, 
                'destination'   => 'Jakarta',
                'date'          => '2026-01-29', // Tanggal lapor (setelah pulang)
                'subject'       => 'Laporan Hasil Koordinasi Teknis Pengembangan Sistem',
                'report_file'   => 'reports/sample_lpd_001.pdf',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'report_id'     => 'LPD-2026-002',
                'employee_id'   => $employee->id,
                'letter_number' => $letter->id,
                'destination'   => 'Sleman',
                'date'          => '2026-02-03',
                'subject'       => 'Laporan Audit Infrastruktur Lapangan',
                'report_file'   => 'reports/sample_lpd_002.pdf',
                'created_at'    => now(),
                'updated_at'    => now(),
            ]
        ]);
    }
}