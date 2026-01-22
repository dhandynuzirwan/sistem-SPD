<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Letter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $employee = $user->employee; // Mengambil data profil employee
                $role = $employee->role;

                $notifications = collect();
                $notificationCount = 0;

                if ($role === 'director' || $role === 'finance') {
                    // Atasan & Finance: Notifikasi surat yang butuh persetujuan (Pending)
                    $notifications = Letter::where('status', 'pending')
                                            ->latest()
                                            ->take(5)
                                            ->get();
                    $notificationCount = Letter::where('status', 'pending')->count();
                    
                } elseif ($role === 'employee') {
                    // Pegawai: Notifikasi surat mereka yang sudah di-Approve atau di-Reject
                    // Kita ambil surat terbaru yang statusnya bukan pending
                    $notifications = Letter::where('employee_id', $employee->id)
                                            ->whereIn('status', ['approved', 'rejected'])
                                            ->latest()
                                            ->take(5)
                                            ->get();
                    
                    $notificationCount = Letter::where('employee_id', $employee->id)
                                            ->whereIn('status', ['approved', 'rejected'])
                                            ->count();
                }

                $view->with([
                    'pendingNotificationCount' => $notificationCount,
                    'listNotifications'        => $notifications // Mengubah nama agar lebih umum
                ]);
            }
        });
    }
}