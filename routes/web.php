<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// home
Route::get('/', [HomeController::class, 'index']);
Route::get('home/post/{post}', [HomeController::class, 'detail']);
// registrasi
Route::get('register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store']);
// authentication
Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout']);
// post
Route::resource('post', DashboardPostController::class)->middleware('auth');
// category
Route::resource('category', CategoryController::class)->middleware('admin')->except('show','edit','create');
// user
Route::resource('user', UserController::class)->middleware('admin')->except('show','edit','create');
Route::get('profile', [UserController::class, 'profile'])->middleware('auth');
Route::put('profile/{user}', [UserController::class, 'editProfile'])->middleware('auth');