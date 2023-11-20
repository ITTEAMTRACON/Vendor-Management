<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrequalificationController;
use App\Http\Controllers\QhseController;
use App\Http\Controllers\Auth\PasswordController;
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

Route::get('/', function () {
    return view('landingpage.index');
});

route::post('/post-login', [LoginUserController::class, 'post_login'])->name('login.post');
route::post('/post-register', [RegisteredUserController::class, 'store'])->name('register.post');
route::post('/post-forget-password', [PasswordController::class, 'forget_password'])->name('forget-password.post');

route::get('/reset-password-view/{token}', [PasswordController::class, 'reset_password_view'])->name('reset-password.view');
route::post('/reset-password-store', [PasswordController::class, 'reset_password_store'])->name('reset-password.store');

route::get('/register-link/{token}', [RegisteredUserController::class, 'register_link'])->name('register.view');
route::post('/register-link', [RegisteredUserController::class, 'register_link_store'])->name('register.store');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/change-password', [PasswordController::class, 'view_change_pasword'])->name('password.view');
    Route::patch('/change-password-update', [PasswordController::class, 'update'])->name('password.change-password-update');



    Route::get('/pre-qualification', [PrequalificationController::class, 'index'])->name('prequalification.index');
    Route::get('/pre-qualification/detail/{SESSION_UUID}', [PrequalificationController::class, 'view'])->name('prequalification.detail');
    Route::get('/pre-qualification/store', [PrequalificationController::class, 'store'])->name('prequalification.store');

    Route::get('/qhse', [QhseController::class, 'index'])->name('qhse.index');
    Route::get('/qhse/detail/{SESSION_UUID}', [QhseController::class, 'view'])->name('qhse.detail');
    Route::get('/qhse/store', [QhseController::class, 'store'])->name('qhse.store');


    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/contact-person', [ProfileController::class, 'update_contact_person'])->name('profile.update-contact-person');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
