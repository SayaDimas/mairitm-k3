<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Auth::routes();
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/update-role/{id}', [AdminController::class, 'updateRole'])->name('admin.updateRole');
    Route::post('/admin/create-admin', [AdminController::class, 'createAdmin'])->name('admin.createAdmin');
});


Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/home', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    Route::get('/guru', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    Route::post('/guru/add-student', [GuruController::class, 'addStudent'])->name('guru.addStudent');
    Route::put('/guru/edit-student/{id}', [GuruController::class, 'editStudent'])->name('guru.editStudent');
    Route::delete('/guru/delete-student/{id}', [GuruController::class, 'deleteStudent'])->name('guru.deleteStudent');
     // Menampilkan dashboard guru
     Route::get('/guru', [GuruController::class, 'dashboard'])->name('guru.dashboard');

     // Menampilkan modul-modul yang dimiliki oleh guru
     Route::get('/guru/modules', [GuruController::class, 'showModules'])->name('guru.modules.index');

     // Menambahkan modul baru
     Route::get('/guru/modules/create', [GuruController::class, 'createModule'])->name('guru.modules.create');
     Route::post('/guru/modules', [GuruController::class, 'addModule'])->name('guru.modules.store');
// edit module
     Route::get('/guru/modules/{id}/edit', [GuruController::class, 'editModule'])->name('guru.modules.edit');
     Route::post('/guru/modules/{id}', [GuruController::class, 'updateModule'])->name('guru.modules.update');
     Route::get('/guru/modules/{id}/materi', [GuruController::class, 'addMateri'])->name('guru.modules.add_materi');
     Route::post('guru/modules/{moduleId}/materi', [GuruController::class, 'storeMateri'])->name('guru.modules.store_materi');
     Route::delete('/materi/{id}', [GuruController::class, 'destroy'])->name('guru.modules.destroy_materi');
});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/home', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/siswa/kategori/{id}', [CategoryController::class, 'show'])->name('kategori.show');
    Route::get('materi/{module_id}/{materi_id}', [SiswaController::class, 'show'])->name('materi.show');
});
