<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\AdminAccountController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ReviewController;

use App\Models\Location;
use App\Models\Tour;
use App\Models\Category;
use App\Http\Controllers\SliderController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
//     return view('user.homepage');
// });

// Route Admin


Route::get('/admin/', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


// Tour Management


Route::get('/admin/tour_management/index', [TourController::class, 'index'])->name('admin.tour_management.index');
Route::get('/admin/tour_management/create', [TourController::class, 'create'])->name('admin.tour_management.create');
Route::post('admin/tour_management/store',[TourController::class, 'store'])->name('admin.tour_management.store');
Route::get('/admin/tours/{tour}', [TourController::class, 'show'])->name('admin.tour_management.show');
Route::delete('/tours/{tour}', [TourController::class, 'destroy'])->name('admin.tour_management.destroy'); 
Route::get('admin/tours/{tour}/edit', [TourController::class, 'edit'])->name('admin.tour_management.edit');
Route::put('admin/tours/{tour}', [TourController::class, 'update'])->name('admin.tour_management.update');

// Category Route

Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index'); // Danh sách danh mục
Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create'); // Form thêm danh mục
Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store'); // Xử lý lưu danh mục
Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit'); // Form sửa danh mục
Route::get('admin/categories/{category}',[CategoryController::class, 'show'])->name('admin.categories.show'); // Xem chi tiết danh mục
Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update'); // Xử lý sửa danh mục
Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy'); // Xử lý xóa danh mục


// Location Route

Route::get('/admin/locations', [LocationController::class, 'index'])->name('admin.locations.index'); // Danh sách địa điểm
Route::get('/admin/locations/create', [LocationController::class, 'create'])->name('admin.locations.create'); // Form thêm địa điểm
Route::post('/admin/locations', [LocationController::class, 'store'])->name('admin.locations.store'); // Xử lý lưu địa điểm

//Route Account Amin
Route::get('/admin/account_admin/index', [AdminAccountController::class, 'index'])->name(('admin.account_admin.index'));
Route::get('/admin/account_admin/create', [AdminAccountController::class, 'create'])->name('admin.account_admin.create');
Route::delete('/admin/account_admin/{admin}', [AdminAccountController::class, 'destroy'])->name('admin.account_admin.destroy');
Route::get('/admin/account_admin/{admin}/edit', [AdminAccountController::class, 'edit'])->name('admin.account_admin.edit');
Route::post('/admin/account_admin/store', [AdminAccountController::class, 'store'])->name('admin.account_admin.store');
Route::put('/admin/account_admin/{admin}', [AdminAccountController::class, 'update'])->name('admin.account_admin.update');

// Route Account User
Route::get('/admin/account_user/index', [UserController::class, 'index'])->name('admin.account_user.index');
Route::get('/admin/account_user/create', [UserController::class, 'create'])->name('admin.account_user.create');
Route::post('/admin/account_user/store', [UserController::class, 'store'])->name('admin.account_user.store');
Route::delete('/admin/account_user/{user}', [UserController::class, 'destroy'])->name('admin.account_user.destroy');
Route::get('/admin/account_user/{user}/edit', [UserController::class, 'edit'])->name('admin.account_user.edit');
Route::put('/admin/account_user/{user}', [UserController::class, 'update'])->name('admin.account_user.update');
Route::get('/admin/account_user/{user}', [UserController::class, 'show'])->name('admin.account_user.show');

// Route Scheule
Route::get('admin/tours/{tour}/schedules', [ScheduleController::class, 'index'])->name('admin.schedules.index');
Route::get('admin/tours/{tour}/schedules/create', [ScheduleController::class, 'create'])->name('admin.schedules.create');
Route::post('admin/tours/{tour}/schedules', [ScheduleController::class, 'store'])->name('admin.schedules.store');
Route::get('admin/tours/{tour}/schedules/{schedule}/edit', [ScheduleController::class, 'edit'])->name('admin.schedules.edit');
Route::put('admin/tours/{tour}/schedules/{schedule}', [ScheduleController::class, 'update'])->name('admin.schedules.update');
Route::delete('admin/tours/{tour}/schedules/{schedule}', [ScheduleController::class, 'destroy'])->name('admin.schedules.destroy');

// Route Booking
Route::get('admin/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
Route::patch('/admin/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('admin.bookings.updateStatus');
Route::patch('/admin/bookings/{booking}/confirm', [BookingController::class, 'confirm'])->name('admin.bookings.confirm');
Route::patch('/admin/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('admin.bookings.cancel');




// Router Hotel
Route::get('/admin/hotels', [HotelController::class, 'index'])->name('admin.hotels.index');
Route::get('/admin/hotels/create', [HotelController::class, 'create'])->name('admin.hotels.create');
Route::post('/admin/hotels', [HotelController::class, 'store'])->name('admin.hotels.store');
Route::get('/admin/hotels/{hotel}/edit', [HotelController::class, 'edit'])->name('admin.hotels.edit');
Route::put('/admin/hotels/{hotel}', [HotelController::class, 'update'])->name('admin.hotels.update');
Route::delete('/admin/hotels/{hotel}', [HotelController::class, 'destroy'])->name('admin.hotels.destroy');

// Route Slider
Route::get('/admin/sliders', [SliderController::class, 'index'])->name('admin.sliders.index');
Route::get('/admin/sliders/create', [SliderController::class, 'create'])->name('admin.sliders.create');
Route::post('/admin/sliders', [SliderController::class, 'store'])->name('admin.sliders.store');
Route::get('/admin/sliders/{slider}/edit', [SliderController::class, 'edit'])->name('admin.sliders.edit');
Route::put('/admin/sliders/{slider}', [SliderController::class, 'update'])->name('admin.sliders.update');
Route::delete('/admin/sliders/{slider}', [SliderController::class, 'destroy'])->name('admin.sliders.destroy');

// Route Review
Route::get('/admin/reviews/{tourID}', [ReviewController::class, 'showReview'])->name('admin.reviews.index');

// Route trên trang user

// Chia sẻ dữ liệu categories và locations cho navbar
// view()->share([
//     'categories' => Category::all(),
//     'locations' => Location::all()
// ]);

// Trang chủ (hiển thị danh sách danh mục và địa điểm)
Route::get('/', function () {
    return view('user.homepage');
})->name('user.homepage');

// Hiển thị danh sách tour theo danh mục
Route::get('/category/{category}', function (Category $category) {
    return view('user.category_tour', [
        'category' => $category,
        'tours' => $category->tours
    ]);
})->name('user.category_tour');

// Chi tiết tour
Route::get('/tour/{id}', [TourController::class, 'showInUser'])->name('user.detail_tour');

// Xử lý đăng nhập
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return redirect('/')->with('success', 'Đăng nhập thành công!');
    }

    return back()->withErrors(['error' => 'Email hoặc mật khẩu không đúng!']);
})->name('user.login');

// Xử lý đăng ký
Route::post('/register', function (Request $request) {
    $user = User::create($request->only(['name', 'email', 'password']));
    Auth::login($user);

    return redirect('/')->with('success', 'Đăng ký thành công!');
})->name('user.register');

// Đăng xuất
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/')->with('success', 'Đăng xuất thành công!');
})->name('user.logout');


Route::get('/book-tour/{tour}', [BookingController::class, 'showBookingForm'])->name('booking.order');
Route::post('/book-tour/{tour}', [BookingController::class, 'store'])->name('bookings.store');

// Reset password
Route::get('/forgot-password', function () {
    return view('user.reset_password');
})->name('user.reset_password');

Route::post('/forgot-password', [UserController::class, 'forgotPassword'])->name('user.forgot_password');

Route::get('/change-password', function () {
    return view('user.changePassword');
})->name('user.changePassword');

Route::get('/profile', [UserController::class, 'profile'])->name('user.profile')->middleware('auth');
Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('user.editProfile');
Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('user.updateProfile');

Route::get('/change-password', [UserController::class, 'showChangePasswordForm'])->name('user.change-password');
Route::post('/change-password', [UserController::class, 'updatePassword'])->name('user.update-password');

Route::get('/tours/search', [TourController::class, 'search'])->name('tours.search');

Route::get('/booked-tours', [BookingController::class, 'bookedTours'])->name('booked-tours')->middleware('auth');
Route::post('/cancel-booking/{id}', [BookingController::class, 'cancelBooking'])->name('cancel-booking');


Route::post('/reviews/store/{tour}', [ReviewController::class, 'store'])->name('reviews.store');
