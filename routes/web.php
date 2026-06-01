<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\ManajemenOrmawa;
use App\Livewire\Admin\ProgramKerja;
use App\Livewire\Admin\ProkerDetail;
use App\Livewire\Admin\Laporan;
use App\Livewire\Admin\Evaluasi;
use App\Http\Controllers\Admin\LaporanExportController;
use App\Livewire\Ormawa\Dashboard as OrmawaDashboard;
use App\Livewire\Ormawa\ProgramKerja as OrmawaProgramKerja;
use App\Livewire\Ormawa\Laporan as OrmawaLaporan;
use App\Livewire\Profile as ProfilePage;

Route::view('/', 'welcome');

Route::get('profile', ProfilePage::class)
    ->middleware(['auth'])
    ->name('profile');

// Redirector Pintar: Jika user tanpa sengaja mengakses '/dashboard'
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin_kampus') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('ormawa.dashboard');
})->middleware(['auth'])->name('dashboard');

// ==========================================
// ROUTE KHUSUS ADMIN KAMPUS
// ==========================================
Route::prefix('admin')
    ->middleware(['auth', 'role:admin_kampus']) // <-- Proteksi middleware role
    ->group(function () {
        
        Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');
        Route::get('/ormawa', ManajemenOrmawa::class)->name('admin.ormawa');
        Route::get('/proker', ProgramKerja::class)->name('admin.proker');
        Route::get('/proker/{id}', ProkerDetail::class)->name('admin.proker.detail');
        Route::get('/laporan', Laporan::class)->name('admin.laporan');
        Route::get('/evaluasi', Evaluasi::class)->name('admin.evaluasi');
        Route::get('/laporan/export', [LaporanExportController::class, 'export'])->name('admin.laporan.export');
});

// ==========================================
// ROUTE KHUSUS ADMIN ORMAWA
// ==========================================
Route::prefix('ormawa')
    ->middleware(['auth', 'role:admin_ormawa'])
    ->group(function () {
        Route::get('/dashboard', OrmawaDashboard::class)->name('ormawa.dashboard');
        Route::get('/proker', OrmawaProgramKerja::class)->name('ormawa.proker');
        Route::get('/laporan', OrmawaLaporan::class)->name('ormawa.laporan');
});

require __DIR__.'/auth.php';