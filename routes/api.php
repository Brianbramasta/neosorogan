<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SiswaController;
use App\Http\Controllers\Api\GuruController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\MateriController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Siswa Routes
Route::middleware(['auth:sanctum', 'role:student'])->group(function () {
    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard']);
    Route::apiResource('tugas', SiswaController::class);
    Route::get('/kalender', [SiswaController::class, 'kalender']);
});

// Guru Routes
Route::middleware(['auth:sanctum', 'role:teacher'])->group(function () {
    Route::apiResource('kelas', GuruController::class);
    Route::get('/kelas/{id}/siswa', [GuruController::class, 'getSiswa']);
    Route::post('/kelas/{id}/siswa', [GuruController::class, 'addSiswa']);
    Route::delete('/kelas/{id}/siswa/{siswa_id}', [GuruController::class, 'removeSiswa']);
    Route::get('/tugas/siswa/{siswa_id}', [GuruController::class, 'getTugasSiswa']);
    Route::put('/tugas/{tugas_id}/nilai', [GuruController::class, 'nilaiTugas']);
});

// Admin Routes
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'index']);
    Route::put('/admin/users/{id}', [AdminController::class, 'update']);
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroy']);
    Route::get('/logs', [AdminController::class, 'logs']);
});

// Materi Routes (accessible by teachers and admin)
Route::middleware(['auth:sanctum', 'role:teacher,admin'])->group(function () {
    Route::apiResource('materi', MateriController::class)->except(['update']);
});
