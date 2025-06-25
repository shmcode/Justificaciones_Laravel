<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminController;


Route::middleware(['auth'])->group(function () {
    Route::get('/student', [StudentController::class, 'index']);
    Route::get('/justifications/create', [StudentController::class, 'create']); // NUEVA RUTA
    Route::post('/justifications', [StudentController::class, 'store']);

    Route::get('/teacher', [TeacherController::class, 'index']);

Route::resource('/teachers', App\Http\Controllers\TeacherAdminController::class);
    Route::get('/admin', [AdminController::class, 'index']);
    Route::post('/justifications/{id}/accept', [AdminController::class, 'accept']);
    Route::post('/justifications/{id}/reject', [AdminController::class, 'reject']);
});


Route::post('/student', [App\Http\Controllers\StudentController::class, 'store'])->name('student.store');

Route::get('/admin/reporte-justificaciones', [App\Http\Controllers\AdminController::class, 'reportePdf'])->name('admin.reporte.pdf');

Route::get('/admin/reporte_pdf', [AdminController::class, 'reportePdf']);
Route::get('/', function () {
    return view('welcome');
});


Route::get('/student/apelaciones', [App\Http\Controllers\StudentController::class, 'apelaciones']);
Route::post('/student/apelar/{id}', [App\Http\Controllers\StudentController::class, 'apelar']);


Route::post('/justifications/{id}/accept', [AdminController::class, 'accept']);
Route::post('/justifications/{id}/reject', [AdminController::class, 'reject']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';