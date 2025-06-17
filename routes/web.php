<?php

use App\Http\Controllers\backend\HargaJualController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\backend\JenisTanamanController;
use App\Http\Controllers\backend\PanenController;
use App\Http\Controllers\backend\PermissionsController;
use App\Http\Controllers\backend\RolesController;
use App\Http\Controllers\backend\TanamanController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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



Route::get('/home', [HomeController::class, 'welcome'])->name('welcome');
Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/users', UserController::class);
    Route::get('/list-data-users',[UserController::class,'listdata']);
    Route::resource('/roles', RolesController::class);
    Route::get('/list-data-roles',[RolesController::class,'listdata']);
    Route::resource('/permissions', PermissionsController::class);
    Route::get('/list-data-permissions',[PermissionsController::class,'listdata']);

    Route::get('/laporan', [TanamanController::class, 'showChart']);
    Route::resource('/tanaman', TanamanController::class);
    Route::get('/list-data-tanaman', [TanamanController::class, 'listdata']);

    Route::resource('/jenis-tanaman', JenisTanamanController::class);
    Route::get('/list-data-jenis-tanaman', [JenisTanamanController::class, 'listdata']);
    Route::get('/get-jenis-tanaman', [JenisTanamanController::class, 'getJenisTanaman']);

    Route::resource('/harga-jual', HargaJualController::class);
    Route::get('/list-data-harga-jual', [HargaJualController::class, 'listdata']);

    Route::resource('/panen', PanenController::class);
    Route::get('/list-data-panen', [PanenController::class, 'listdata']);
    Route::get('/get-harga', [PanenController::class, 'getHarga']);
});

require __DIR__.'/auth.php';
