<?php

use Illuminate\Support\Facades\Route;

/* =========================
   CONTROLLERS
========================= */
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\AdminSoalController;

/* =========================
   WELCOME
========================= */
Route::get('/', function () {
    return view('welcome');
});

/* =========================
   AUTH + VERIFIED
========================= */
Route::middleware(['auth', 'verified'])->group(function () {

    /* =========================
       DASHBOARD REDIRECT ROLE
    ========================= */
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $role = $user->role;
        if ($user->dosenKaprodi) {
            $role = $user->dosenKaprodi->jabatan;
        }

        return redirect()->route($role . '.dashboard');

    })->name('dashboard');

    /* =========================
       MAHASISWA
    ========================= */
    Route::middleware('role:mahasiswa')
        ->prefix('mahasiswa')
        ->name('mahasiswa.')
        ->group(function () {

        /* DASHBOARD */
        Route::get('/dashboard', [MahasiswaController::class, 'index'])
            ->name('dashboard');

        /* TES */
        Route::get('/tes', [QuestionnaireController::class, 'index'])
            ->name('tes.index');

        Route::post('/tes', [QuestionnaireController::class, 'store'])
            ->name('tes.store');

        /* HASIL TES */
        Route::get('/tes/hasil/{id}', [QuestionnaireController::class, 'show'])
            ->name('tes.hasil');

        /* DOWNLOAD PDF */
        Route::get('/tes/pdf/{id}', [QuestionnaireController::class, 'downloadPdf'])
            ->name('tes.pdf');

        /* HISTORY */
        Route::get('/history', [MahasiswaController::class, 'history'])
            ->name('history');


    });

    /* =========================
       ADMIN
    ========================= */
    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

        /* DASHBOARD */
        Route::get('/dashboard', [AdminController::class, 'index'])
            ->name('dashboard');

        /* =========================
           USER CRUD
        ========================= */

        /* LIST USER */
        Route::get('/users', [AdminController::class, 'users'])
            ->name('users.index');

        /* CREATE USER */
        Route::get('/users/create', [AdminController::class, 'createUser'])
            ->name('users.create');

        Route::post('/users', [AdminController::class, 'storeUser'])
            ->name('users.store');

        /* EDIT USER */
        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])
            ->name('users.edit');

        Route::put('/users/{id}', [AdminController::class, 'updateUser'])
            ->name('users.update');

        /* DETAIL USER */
        Route::get('/users/{id}', [AdminController::class, 'showUser'])
            ->name('users.show');

        /* DELETE USER */
        Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])
            ->name('users.destroy');

        /* =========================
           SOAL CRUD
        ========================= */

        Route::get('/soal', [AdminSoalController::class, 'index'])
            ->name('soal.index');

        Route::get('/soal/create', [AdminSoalController::class, 'create'])
            ->name('soal.create');

        Route::post('/soal', [AdminSoalController::class, 'store'])
            ->name('soal.store');

        Route::get('/soal/{id}/edit', [AdminSoalController::class, 'edit'])
            ->name('soal.edit');

        Route::put('/soal/{id}', [AdminSoalController::class, 'update'])
            ->name('soal.update');

        Route::delete('/soal/{id}', [AdminSoalController::class, 'destroy'])
            ->name('soal.destroy');

        /* =========================
           RISK LEVEL CRUD
        ========================= */

        Route::get('/risk-levels', [AdminController::class, 'riskLevels'])
            ->name('risk-levels.index');

        Route::get('/risk-levels/create', [AdminController::class, 'createRiskLevel'])
            ->name('risk-levels.create');

        Route::post('/risk-levels', [AdminController::class, 'storeRiskLevel'])
            ->name('risk-levels.store');

        Route::get('/risk-levels/{id}/edit', [AdminController::class, 'editRiskLevel'])
            ->name('risk-levels.edit');

        Route::put('/risk-levels/{id}', [AdminController::class, 'updateRiskLevel'])
            ->name('risk-levels.update');

        Route::delete('/risk-levels/{id}', [AdminController::class, 'destroyRiskLevel'])
            ->name('risk-levels.destroy');

        /* =========================
           HASIL TES
        ========================= */

        Route::get('/hasil-tes', [AdminController::class, 'hasilTes'])
            ->name('hasil.index');

        Route::get('/hasil-tes/{id}/pdf', [AdminController::class, 'downloadTesPdf'])
            ->name('hasil.download');

        /* =========================
           MAHASISWA BIMBINGAN PER DOSEN
        ========================= */

        Route::get('/mahasiswa', [AdminController::class, 'mahasiswaByDosen'])
            ->name('mahasiswa.index');

        /* HELP */
        Route::get('/help', [AdminController::class, 'help'])
            ->name('help');
    });

    /* =========================
       DOSEN
    ========================= */
    Route::middleware('role:dosen')
        ->prefix('dosen')
        ->name('dosen.')
        ->group(function () {

        Route::get('/dashboard', [DosenController::class, 'index'])
            ->name('dashboard');

        Route::get('/mahasiswa', [DosenController::class, 'mahasiswa'])
            ->name('mahasiswa');

        /* HELP */
        Route::get('/help', [DosenController::class, 'help'])
            ->name('help');
    });

    /* =========================
       KAPRODI
    ========================= */
    Route::middleware('role:kaprodi')
        ->prefix('kaprodi')
        ->name('kaprodi.')
        ->group(function () {

        Route::get('/dashboard', [KaprodiController::class, 'index'])
            ->name('dashboard');

        Route::get('/statistik', [KaprodiController::class, 'statistik'])
            ->name('statistik');

        Route::get('/mahasiswa-bimbingan', [KaprodiController::class, 'mahasiswaBimbingan'])
            ->name('mahasiswa-bimbingan');

        Route::get('/dosen/{id}/mahasiswa', [KaprodiController::class, 'mahasiswaByDosen'])
            ->name('dosen.mahasiswa');
            
        Route::post('/notifications/read-all', [KaprodiController::class, 'markAllNotificationsAsRead'])
            ->name('notifications.read-all');

        Route::post('/notifications/{id}/read', [KaprodiController::class, 'markNotificationAsRead'])
            ->name('notifications.read');

        /* HELP */
        Route::get('/help', [KaprodiController::class, 'help'])
            ->name('help');
    });

    /* =========================
       PROFILE
    ========================= */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/* =========================
   AUTH ROUTES
========================= */
require __DIR__.'/auth.php';

/* =========================
   BIMBINGAN
========================= */
Route::middleware('auth')->group(function () {

    Route::get('/bimbingan', [BimbinganController::class, 'index']);

    Route::get('/bimbingan/create', [BimbinganController::class, 'create']);

    Route::post('/bimbingan', [BimbinganController::class, 'store']);
});