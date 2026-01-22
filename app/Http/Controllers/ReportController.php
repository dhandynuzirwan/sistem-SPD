<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth::user()->employee->role;
        
        if ($role === 'employee') {
            // Pegawai hanya melihat miliknya sendiri
            $reports = \App\Models\Report::where('employee_id', Auth::user()->employee->id)->get();
        } else {
            // Finance dan Director melihat semua laporan
            $reports = \App\Models\Report::all();
        }   
        
        return match($role) {
            'employee' => view('employee.lpd.index', compact('reports')),
            'finance'  => view('finance.lpd.index', compact('reports')),
            'director' => view('director.lpd.index', compact('reports')),
            default    => abort(403, 'Akses Ditolak'),
        };
    }

    // public function index()
    // {
    //     $role = auth()->user()->role; // Ambil role user dari database

    //     if ($role === 'finance') {
    //         return view('finance.lpd.index');
    //     } elseif ($role === 'employee') {
    //         return view('employee.lpd.index');
    //     } elseif ($role === 'director') {
    //         return view('director.lpd.index');
    //     }

    //     // Berikan fallback jika role tidak ditemukan
    //     abort(403, 'Halaman tidak ditemukan untuk role Anda.');
    // }


    public function create()
    {
        $letters = \App\Models\Letter::all();
        $employees = \App\Models\Employee::whereRaw('LOWER(role) = ?', ['employee'])->get();
        return view('employee.lpd.create', compact('letters', 'employees'));
    }

    // Schema::create('reports', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('report_id')->unique();
    //         $table->foreignId('employee_id')->constrained('employees');
    //         $table->foreignId('letter_number')->constrained('letters');
    //         $table->string('destination');
    //         $table->date('date');
    //         $table->string('subject');
    //         $table->string('report_file');
    //         $table->timestamps();
    //     });
    
    public function store(Request $request)
    {
        // 1. Validasi Data
        $request->validate([
            'report_id'     => 'required|unique:reports,report_id',
            'letter_number' => 'required|exists:letters,id', // Foreign key ke tabel letters
            'destination'   => 'required|string|max:255',
            'date'          => 'required|date',
            'subject'       => 'required|string|max:255',
            'report_file'   => 'required|file|mimes:pdf,jpg,png|max:10240', // Ubah ke file (max 10MB)
        ]);

        // 2. Olah File yang Diunggah
        if ($request->hasFile('report_file')) {
            $file = $request->file('report_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/reports', $fileName, 'public');
        }

        // 3. Simpan Data
        Report::create([
            'report_id'     => $request->report_id,
            'employee_id'   => Auth::user()->employee->id, // Otomatis ambil ID pegawai yang login
            'letter_number' => $request->letter_number,
            'destination'   => $request->destination,
            'date'          => $request->date,
            'subject'       => $request->subject,
            'report_file'   => $filePath, // Simpan path file
        ]);

        return redirect()->route('reports.index')->with('success', 'LPD berhasil dibuat.');
        
    }

    public function edit($id)
    {
        $report = Report::findOrFail($id);
        $employees = \App\Models\Employee::all();
        $letters = \App\Models\Letter::all();

        return view('employee.lpd.edit', compact('report', 'employees', 'letters'));
    }

    public function update(Request $request, $id)
    {
        $report = Report::findOrFail($id);

    $request->validate([
        'employee_id'   => 'required|exists:employees,id',
        'letter_number' => 'required|exists:letters,id',
        'destination'   => 'required|string|max:255',
        'date'          => 'required|date',
        'subject'       => 'required|string',
        'report_file'   => 'nullable|file|mimes:pdf,jpg,png|max:10240', // nullable karena bersifat opsional saat edit
    ]);

    $data = $request->all();

    // Jika ada file baru yang diunggah
    if ($request->hasFile('report_file')) {
        // Hapus file lama jika ingin menghemat storage (opsional)
        if ($report->report_file) {
            Storage::disk('public')->delete($report->report_file);
        }
        $data['report_file'] = $request->file('report_file')->store('reports', 'public');
    } else {
        // Tetap gunakan file lama jika tidak ada unggahan baru
        $data['report_file'] = $report->report_file;
    }

    $report->update($data);

    return redirect()->route('reports.index')->with('success', 'Laporan Perjalanan Dinas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
