<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class printKwitansiController extends Controller
{
    private function terbilang($angka) {
        $angka = abs($angka);
        $baca = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"];
        $terbilang = "";

        if ($angka < 12) { $terbilang = " " . $baca[$angka]; }
        elseif ($angka < 20) { $terbilang = $this->terbilang($angka - 10) . " Belas"; }
        elseif ($angka < 100) { $terbilang = $this->terbilang($angka / 10) . " Puluh" . $this->terbilang($angka % 10); }
        elseif ($angka < 200) { $terbilang = " Seratus" . $this->terbilang($angka - 100); }
        elseif ($angka < 1000) { $terbilang = $this->terbilang($angka / 100) . " Ratus" . $this->terbilang($angka % 100); }
        elseif ($angka < 2000) { $terbilang = " Seribu" . $this->terbilang($angka - 1000); }
        elseif ($angka < 1000000) { $terbilang = $this->terbilang($angka / 1000) . " Ribu" . $this->terbilang($angka % 1000); }
        elseif ($angka < 1000000000) { $terbilang = $this->terbilang($angka / 1000000) . " Juta" . $this->terbilang($angka % 1000000); }

        return $terbilang;
    }
    public function printKwitansi($id) {
    $letter = \App\Models\Letter::with(['employee', 'budget', 'finance'])->findOrFail($id);
    
    $terbilang = $this->terbilang($letter->budget->total) . " Rupiah";
    
    $pdf = Pdf::loadView('employee.spd.kwitansi', compact('letter', 'terbilang'));
    
    $fileName = 'Kwitansi-' . str_replace('/', '-', $letter->letter_number) . '.pdf';
    return $pdf->stream($fileName);
}
}
