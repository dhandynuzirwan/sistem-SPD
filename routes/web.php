<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// 1. Redirect Root ke Login
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. Authentication Routes
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login')->middleware('guest');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

// 3. Rute Dashboard (Dipisah berdasarkan Role)
Route::middleware(['auth', 'role:finance'])->group(function () {
    Route::get('/finance/dashboard', function () {
        return view('finance.dashboard'); 
    })->name('finance.dashboard'); 
    
    // Fitur Khusus Finance Saja
    Route::resource('employees', EmployeeController::class);
});

Route::middleware(['auth', 'role:director'])->group(function () {
    Route::get('/director/dashboard', function () {
        return view('director.dashboard');
    })->name('director.dashboard');

    Route::patch('/letters/{id}/approve', [LetterController::class, 'approve'])->name('letters.approve');
});

Route::middleware(['auth', 'role:employee'])->group(function () {
    Route::get('/employee/dashboard', function () {
        return view('employee.dashboard');
    })->name('employee.dashboard');
});

// 4. Rute Bersama (Shared Resources)
// Rute ini bisa diakses oleh siapa saja yang sudah Login (Auth)
// Pembatasan hak akses (siapa bisa edit/hapus) dilakukan di dalam CONTROLLER, bukan di Route.
Route::middleware(['auth'])->group(function () {
    
    // Surat Perjalanan Dinas (Diakses Finance, Employee, Director)
    Route::resource('letters', LetterController::class);

    // Laporan Perjalanan Dinas (Diakses Finance, Employee, Director)
    Route::resource('reports', ReportController::class);

    // Anggaran (Finance Full Akses, Employee cuma Lihat/Cetak)
    Route::resource('budgets', BudgetController::class);

    Route::get('/letters/{id}/print', [LetterController::class, 'print'])->name('letters.print');
});



// HAPUS SEMUA KODE DI BAWAH INI (Yang ada di file lama Anda)
// Karena manual route di bawah ini akan bentrok dengan Resource Controller di atas.