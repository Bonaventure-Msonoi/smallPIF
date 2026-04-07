<?php

use App\Http\Controllers\BusinessSubmissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'submissionOnly'])->group(function () {
    Route::get('/', [BusinessSubmissionController::class, 'create'])->name('submissions.create');
    Route::post('/submissions', [BusinessSubmissionController::class, 'store'])->name('submissions.store');

    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::get('/admin/export', [BusinessSubmissionController::class, 'exportForm'])->name('submissions.export.form');
        Route::get('/admin/export/download', [BusinessSubmissionController::class, 'export'])->name('submissions.export');

        Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
        Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    });
});

Route::get('/dashboard', function () {
    if (auth()->user()?->is_admin) {
        return view('dashboard');
    }
    return redirect()->route('submissions.create');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
