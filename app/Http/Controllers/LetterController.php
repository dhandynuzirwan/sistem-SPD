<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    public function index() {
        $letters = Letter::with(['finance', 'director', 'employee', 'budget'])->get();
        return view('finance.spd.index', compact('letters'));
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
}
