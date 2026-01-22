<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index() {
        $user = Auth::user();
        $role = $user->employee->role;

        // 1. Gunakan Query Builder agar lebih efisien dan dukung Eager Loading
        $query = \App\Models\Budget::with(['letter.employee']);

        if ($role === 'employee') {
            // 2. Filter budget melalui tabel letters (karena employee_id ada di sana)
            $budgets = $query->whereHas('letter', function ($q) use ($user) {
                $q->where('employee_id', $user->employee->id)
                ->where('status', 'approved'); // Opsional: Hanya budget yang sudah disetujui
            })->get();
        } else {
            // 3. Finance dan Director melihat semua anggaran
            $budgets = $query->get();
        }

        // 4. Return View sesuai folder yang sudah Anda rapikan
        return match($role) {
            'employee' => view('employee.budget.index', compact('budgets')),
            'finance'  => view('finance.budget.index', compact('budgets')),
            'director' => view('director.budget.index', compact('budgets')),
            default    => abort(403, 'Akses Ditolak'),
        };
    }

    public function create() {
        return view('finance.budget.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_budget' => 'required|unique:budgets,id_budget',
            'detail' => 'required|string|max:255',
            'volume' => 'required|integer',
            'unit' => 'required|string|max:100',
            'amount' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        $data = $request->all();
        $data['total'] = $request->volume * $request->amount;

        Budget::create($data);

        return redirect()->route('budgets.index')
                        ->with('success', 'Data anggaran berhasil disimpan!');
    }

    public function edit($id)
    {
        $budget = Budget::findOrFail($id);
        return view('finance.budget.edit', compact('budget'));
    }
    public function update(Request $request, $id)
    {
        $budget = Budget::findOrFail($id);

        $request->validate([
            'id_budget' => 'required|unique:budgets,id_budget,'.$budget->id,
            'detail' => 'required|string|max:255',
            'volume' => 'required|integer',
            'unit' => 'required|string|max:100',
            'amount' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        $budget->update($request->all());

        return redirect()->route('budgets.index')
                        ->with('success', 'Data anggaran berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $budget = Budget::findOrFail($id);
        $budget->delete();

        return redirect()->route('budgets.index')
                        ->with('success', 'Data anggaran berhasil dihapus!');
    }

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

    public function printKwitansi($id)
    {
        // Ambil budget beserta data letter dan employee-nya
        $budget = Budget::with(['letter.employee', 'letter.finance'])->findOrFail($id);

        // Security: Pastikan budget ini milik user yang login (lewat table letters)
        if ($budget->letter->employee_id !== Auth::user()->employee->id) {
            abort(403, 'Anda tidak memiliki akses ke kwitansi ini.');
        }

        $terbilang = trim($this->terbilang($budget->total)) . " Rupiah";
        
        // Sesuaikan path view ke folder yang Anda inginkan
        $pdf = Pdf::loadView('employee.budget.kwitansi', [
            'budget' => $budget,
            'letter' => $budget->letter,
            'terbilang' => $terbilang
        ]);

        return $pdf->stream('Kwitansi-' . $budget->id_budget . '.pdf');
    }

}
