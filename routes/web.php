<?php

use App\Http\Controllers\Backend\HomeController;
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
});

require __DIR__.'/auth.php';
