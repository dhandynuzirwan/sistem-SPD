<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

// ==========================================
// Finance Routes
// ==========================================
Route::get('/finance-dashboard', function () {
    return view('finance.dashboard'); 
})->name('dashboard'); // Menambahkan nama 'dashboard'

// Data Pegawai (Sudah benar menggunakan Resource)

// Route::middleware(['auth', 'role:finance'])->group(function () {
    Route::resource('employees', EmployeeController::class);
    Route::resource('budgets', BudgetController::class);
    Route::resource('letters', LetterController::class);
    Route::resource('reports', ReportController::class);
// });


// Laporan Perjalanan Dinas (LPD)
// Route::get('/finance-lpd', function () {
//     return view('finance.lpd.index'); 
// })->name('reports.index');

// // Surat Perjalanan Dinas (SPD)
// Route::get('/finance-spd', function () {
//     return view('finance.spd.index'); 
// })->name('letters.index');

// Route::get('/finance-spd-create', function () {
//     return view('finance.spd.create'); 
// })->name('letters.create');

// Director Routes

Route::get('/director-dashboard', function () {
    return view('director.dashboard'); 
})->name('director.dashboard');

Route::get('/director-lpd', function () {
    return view('director.lpd.index'); 
});
Route::get('/director-spd', function () {
    return view('director.spd.index'); 
});

// Employee Routes
Route::get('/employee-dashboard', function () {
    return view('employee.dashboard'); 
})->name('employee.dashboard');

Route::get('/employee-lpd', function () {
    return view('employee.lpd.index'); 
});
Route::get('/employee-lpd-create', function () {
    return view('employee.lpd.create'); 
});
Route::get('/employee-spd', function () {
    return view('employee.spd.index'); 
});
Route::get('/employee-kwitansi', function () {
    return view('employee.kwitansi.create'); 
});