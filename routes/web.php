<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\WarehouseDtlController;

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

//login
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/loginAction', [AuthController::class, 'loginAction'])->name('login.action');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth', 'auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    //User
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user');
        Route::post('/add', [UserController::class, 'add'])->name('user.add');
        Route::post('/getData', [UserController::class, 'getData'])->name('user.data');
        Route::post('/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/delete', [UserController::class, 'destroy'])->name('user.delete');
    });
    //profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [AccountController::class, 'profile'])->name('profile');
        Route::post('/getData', [AccountController::class, 'getData'])->name('profile.data');
        Route::post('/edit', [AccountController::class, 'edit'])->name('profile.edit');
        Route::post('/change-password', [AccountController::class, 'changePassword'])->name('profile.changepassword');
    });
    //Product
    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product');
        Route::post('/add', [ProductController::class, 'create'])->name('product.add');
        Route::post('/getData', [ProductController::class, 'getData'])->name('product.data');
        Route::post('/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/delete', [ProductController::class, 'destroy'])->name('product.delete');
    });
    //Warehouse
    Route::prefix('warehouse')->group(function () {
        Route::get('/', [WarehouseController::class, 'index'])->name('warehouse');
        Route::post('/add', [WarehouseController::class, 'create'])->name('warehouse.add');
        Route::post('/getData', [WarehouseController::class, 'getData'])->name('warehouse.data');
        Route::post('/edit', [WarehouseController::class, 'edit'])->name('warehouse.edit');
        Route::post('/delete', [WarehouseController::class, 'destroy'])->name('warehouse.delete');
        //WarehouseDtlController
        Route::get('/detail', [WarehouseDtlController::class, 'warehouse'])->name('warehousedtl');
        Route::post('/detail/add', [WarehouseDtlController::class, 'create'])->name('warehousedtl.add');
        Route::post('/detail/getData', [WarehouseDtlController::class, 'getData'])->name('warehousedtl.data');
        Route::post('/detail/edit', [WarehouseDtlController::class, 'edit'])->name('warehousedtl.edit');

    });
    //Warehouse-detail
    // Route::prefix('warehouse-detail')->group(function () {
    //     Route::get('/', [WarehouseDtlController::class, 'index'])->name('warehouse-detail');
    // });


});