<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LetterController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();
        $role = $user->employee->role;

        // 1. Inisialisasi Query dengan Eager Loading agar tidak N+1
        $query = \App\Models\Letter::with(['finance', 'director', 'employee', 'budget']);

        // 2. Role-Based Scoping (Keamanan Data)
        if ($role === 'employee') {
            $query->where('employee_id', $user->employee->id);
        }

        // 3. Fungsi SEARCH (Berguna untuk input search di navbar)
        $query->when($request->search, function ($q) use ($request) {
            $q->where(function ($inner) use ($request) {
                $inner->where('letter_number', 'like', '%' . $request->search . '%')
                    ->orWhere('subject', 'like', '%' . $request->search . '%')
                    ->orWhere('institution', 'like', '%' . $request->search . '%');
            });
        });

        // 4. Fungsi FILTER STATUS (Berguna untuk klik notifikasi "Pending")
        $query->when($request->status, function ($q) use ($request) {
            $q->where('status', $request->status);
        });

        // 5. Eksekusi Query
        $letters = $query->latest()->get();

        // 6. Return View berdasarkan Role
        return match($role) {
            'employee' => view('employee.spd.index', compact('letters')),
            'finance'  => view('finance.spd.index', compact('letters')),
            'director' => view('director.spd.index', compact('letters')),
            default    => abort(403, 'Akses Ditolak'),
        };
    }
    public function create() {
        // Menggunakan whereRaw agar 'Finance', 'finance', atau 'FINANCE' tetap terpanggil
        $finances = \App\Models\Employee::whereRaw('LOWER(role) = ?', ['finance'])->get();
        // dd($finances);
        $directors = \App\Models\Employee::whereRaw('LOWER(role) = ?', ['director'])->get();
        $employees = \App\Models\Employee::whereRaw('LOWER(role) = ?', ['employee'])->get();
        $budgets = \App\Models\Budget::all();
        
        return view('finance.spd.create', compact('finances', 'directors', 'employees', 'budgets'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'letter_number' => 'required|unique:letters,letter_number',
            'finance_id' => 'required|exists:employees,id',
            'director_id' => 'required|exists:employees,id',
            'employee_id' => 'required|exists:employees,id',
            'budget_id' => 'required|exists:budgets,id',
            'cost_level' => 'required|string|max:100',
            'subject' => 'required|string|max:255',
            'transportation' => 'required|string|max:100',
            'departure_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:departure_date',
            'follower' => 'nullable|string|max:255',
            'follower_name' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'description' => 'nullable|string',
            'institution' => 'required|string|max:255',
        ]);

        $data = $request->all();
        Letter::create($data);

        return redirect()->route('letters.index')
                        ->with('success', 'Surat Perjalanan Dinas berhasil dibuat!');
    }

    public function edit($id)
    {
        $letter = Letter::findOrFail($id);
        return view('finance.spd.edit', compact('letter'));
    }

    public function update(Request $request, $id)
    {
        $letter = Letter::findOrFail($id);

        $request->validate([
            'letter_number' => 'required|unique:letters,letter_number,'.$letter->id,
            'finance_id' => 'required|exists:employees,id',
            'director_id' => 'required|exists:employees,id',
            'employee_id' => 'required|exists:employees,id',
            'budget_id' => 'required|exists:budgets,id',
            'cost_level' => 'required|string|max:100',
            'subject' => 'required|string|max:255',
            'transportation' => 'required|string|max:100',
            'departure_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:departure_date',
            'follower' => 'nullable|string|max:255',
            'follower_name' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'description' => 'nullable|string',
            'institution' => 'required|string|max:255',
        ]);

        $letter->update($request->all());

        return redirect()->route('letters.index')
                        ->with('success', 'Surat Perjalanan Dinas berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $letter = Letter::findOrFail($id);
        $letter->delete();

        return redirect()->route('letters.index')
                        ->with('success', 'Surat Perjalanan Dinas berhasil dihapus!');
    }

    public function approve($id)
    {
        $letter = \App\Models\Letter::findOrFail($id);
        
        // Update status
        $letter->update([
            'status' => 'approved'
        ]);

        return redirect()->back()->with('success', 'Surat Perjalanan Dinas berhasil disetujui.');
    }

    public function print($id)
    {
        $letter = \App\Models\Letter::with(['finance', 'employee', 'director', 'budget'])->findOrFail($id);
        
        $pdf = Pdf::loadView('finance.spd.print', compact('letter'));
        
        // Sanitasi nomor surat: ubah '/' menjadi '-' agar tidak error
        $fileName = 'SPD-' . str_replace('/', '-', $letter->letter_number) . '.pdf';
        
        // Gunakan nama file yang sudah dibersihkan
        return $pdf->stream($fileName);
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
    
    public function printKwitansi($id) {
        // 1. Ambil data spesifik berdasarkan ID
        $letter = \App\Models\Letter::with(['employee', 'budget', 'finance'])->findOrFail($id);

        // 2. Security Check (Penting!)
        // Mencegah pegawai iseng mengganti ID di URL untuk melihat kwitansi orang lain
        if (Auth::user()->employee->role === 'employee' && $letter->employee_id !== Auth::user()->employee->id) {
            abort(403, 'Akses ditolak. Ini bukan kwitansi Anda.');
        }

        // 3. Logika Terbilang
        $terbilang = trim($this->terbilang($letter->budget->total)) . " Rupiah";
        
        // 4. Generate PDF
        $pdf = Pdf::loadView('employee.spd.kwitansi', compact('letter', 'terbilang'));
        
        // 5. Sanitasi Nama File
        $fileName = 'Kwitansi-' . str_replace('/', '-', $letter->letter_number) . '.pdf';
        return $pdf->stream($fileName);
    }
}
