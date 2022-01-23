<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('login', [LoginController::class, 'login']);
Route::post('login_user', [LoginController::class, 'login_user']);
Route::get('register', [RegisterController::class, 'register']);
Route::post('save_user', [RegisterController::class, 'save_user']);
Route::get('usersview', [RegisterController::class, 'usersview'])->name('usersview.usersview');
Route::delete('usersview/{id}', [RegisterController::class, 'deleteuser']);
Route::get('company', [CompanyController::class, 'index'])->name('company.index');
// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect('/home');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();

//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Route::get('/', [LoginController::class, 'login'])->name('home');
// Route::get('login', [LoginController::class, 'login']);
// Route::post('login_user', [LoginController::class, 'login_user']);
// Route::get('register', [RegisterController::class, 'register']);
// Route::post('save_user', [RegisterController::class, 'save_user']);
// Route::get('usersview', [RegisterController::class, 'usersview'])->name('usersview.usersview');
// Route::delete('usersview/{id}', [RegisterController::class, 'deleteuser']);

//company

// Route::get('stuent','App\Http\Controllers\StudentController@index');
// Route::post('student','App\Http\Controllers\StudentController@store')->name('student.store');
// Route::get('student/{id}/edit', 'App\Http\Controllers\StudentController@edit')->name('student.edit');
// Route::post('student/update', 'App\Http\Controllers\StudentController@update')->name('student.update');
// Route::get('student/{id}/delete', 'App\Http\Controllers\StudentController@destroy')->name('student.delete');