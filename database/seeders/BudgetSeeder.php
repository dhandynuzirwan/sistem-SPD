<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $budgets = [
            [
                'id_budget' => 'B-2026-001',
                'detail'    => 'Biaya Transportasi Udara (Yogyakarta - Jakarta)',
                'volume'    => 2,
                'unit'      => 'Tiket',
                'amount'    => 1200000,
            ],
            [
                'id_budget' => 'B-2026-002',
                'detail'    => 'Uang Saku Harian Pegawai',
                'volume'    => 5,
                'unit'      => 'Hari',
                'amount'    => 250000,
            ],
            [
                'id_budget' => 'B-2026-003',
                'detail'    => 'Akomodasi Hotel (Bintang 4)',
                'volume'    => 4,
                'unit'      => 'Malam',
                'amount'    => 750000,
            ],
            [
                'id_budget' => 'B-2026-004',
                'detail'    => 'Biaya Sewa Kendaraan Operasional',
                'volume'    => 3,
                'unit'      => 'Unit',
                'amount'    => 500000,
            ],
        ];

        foreach ($budgets as $data) {
            DB::table('budgets')->insert([
                'id_budget'  => $data['id_budget'],
                'detail'     => $data['detail'],
                'volume'     => $data['volume'],
                'unit'       => $data['unit'],
                'amount'     => $data['amount'],
                // Hitung total otomatis: volume * amount
                'total'      => $data['volume'] * $data['amount'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}