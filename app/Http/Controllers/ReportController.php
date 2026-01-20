<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('finance.lpd.index'); //untuk halaman finance
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
        return view('employee.lpd.create');
    }

    
    public function store(Request $request)
    {
        // Validasi dan simpan data LPD
        return redirect()->route('reports.index')->with('success', 'LPD berhasil dibuat.');

        
    }

    public function show($id)
    {
        //
    }
}
