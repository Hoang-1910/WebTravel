<?php

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

// Route::get('/', function () {
//     return view('user.layout');
// });

// Route Admin
use App\Http\Controllers\AdminAuthController;

Route::get('/admin/', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


// Tour Management
use App\Http\Controllers\TourController;

Route::get('/admin/tour_management/index', [TourController::class, 'index'])->name('admin.tour_management.index');
Route::get('/admin/tour_management/create', [TourController::class, 'create'])->name('admin.tour_management.create');
Route::post('admin/tour_management/store',[TourController::class, 'store'])->name('admin.tour_management.store');
Route::get('/admin/tours/{tour}', [TourController::class, 'show'])->name('admin.tour_management.show');
Route::delete('/tours/{tour}', [TourController::class, 'destroy'])->name('admin.tour_management.destroy'); 
Route::get('admin/tours/{tour}/edit', [TourController::class, 'edit'])->name('admin.tour_management.edit');
Route::put('admin/tours/{tour}', [TourController::class, 'update'])->name('admin.tour_management.update');


// Category Route
use App\Http\Controllers\CategoryController;

Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index'); // Danh sách danh mục
Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create'); // Form thêm danh mục
Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store'); // Xử lý lưu danh mục


// Location Route
use App\Http\Controllers\LocationController;

Route::get('/admin/locations', [LocationController::class, 'index'])->name('admin.locations.index'); // Danh sách địa điểm
Route::get('/admin/locations/create', [LocationController::class, 'create'])->name('admin.locations.create'); // Form thêm địa điểm
Route::post('/admin/locations', [LocationController::class, 'store'])->name('admin.locations.store'); // Xử lý lưu địa điểm

//Route Account Amin
use App\Http\Controllers\AdminAccountController;
Route::get('/admin/account_admin/index', [AdminAccountController::class, 'index'])->name(('admin.account_admin.index'));
Route::get('/admin/account_admin/create', [AdminAccountController::class, 'create'])->name('admin.account_admin.create');
Route::delete('/admin/account_admin/{admin}', [AdminAccountController::class, 'destroy'])->name('admin.account_admin.destroy');