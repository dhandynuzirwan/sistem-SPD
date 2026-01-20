<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    // 1. Menampilkan daftar pegawai
    public function index() {
        $employees = Employee::all();
        return view('finance.employee.index', compact('employees'));
    }

    // 2. Menampilkan form tambah pegawai
    public function create() {
        return view('finance.employee.create');
    }

    // 3. Menyimpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:employees,nik|digits:16',
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required|date',
            'position' => 'required',
            'username' => 'required|unique:employees,username',
            'password' => 'required|min:6',
            'role' => 'required|in:finance,employee,director',
        ], [
        // Opsional: Custom pesan dalam Bahasa Indonesia
        'nik.unique'     => 'NIK ini sudah terdaftar di sistem.',
        'nik.digits'     => 'NIK harus berjumlah 16 digit.',
        'password.min'   => 'Password minimal harus 6 karakter.',
        'username.unique'=> 'Username sudah digunakan, cari yang lain.',
    ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')
                        ->with('success', 'Data pegawai berhasil disimpan!');
    }

    public function edit($id)
    {
        // Mencari data pegawai berdasarkan ID, jika tidak ketemu akan error 404
        $employee = \App\Models\Employee::findOrFail($id);

        // Mengarahkan ke halaman edit di folder finance/employee/edit.blade.php
        return view('finance.employee.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        // 1. Cari data pegawai
        $employee = \App\Models\Employee::findOrFail($id);

        // 2. Validasi data
        $request->validate([
            'nik'            => ['required', Rule::unique('employees')->ignore($employee->id)],
            'username'       => ['required', Rule::unique('employees')->ignore($employee->id)],
            'full_name'      => 'required|string|max:255',
            'gender'         => 'required|in:male,female',
            'place_of_birth' => 'required',
            'date_of_birth'  => 'required|date',
            'position'       => 'required',
            'role'           => 'required|in:finance,employee,director',
        ]);

        // 3. Ambil semua input kecuali password
        $data = $request->except('password');

        // 4. Logika Password: Hanya update jika diisi
        if ($request->filled('password')) {
            $data['password'] = $request->password; 
            // Password akan otomatis di-hash oleh Mutator di Model yang kita buat sebelumnya
        }

        // 5. Update ke database
        $employee->update($data);

        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $employee = \App\Models\Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil dihapus');
    }
}
