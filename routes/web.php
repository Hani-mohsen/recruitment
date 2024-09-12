<?php

use App\Http\Controllers\AvailableJobController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\InterviewReviewController;
use App\Http\Controllers\JobApplyController;
use App\Http\Controllers\JobCondidateController;
use App\Models\User;
// Authentication Routes
Auth::routes();
Route::middleware('guest')->group(function () {
    Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
});
// Authentication Routes
// Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('/login', 'Auth\LoginController@login');
// Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// // Registration Routes
// Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('/register', 'Auth\RegisterController@register');

// // Password Reset Routes
// Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

// // Email Verification Routes
// Route::get('/email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('/email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::get('/email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

// route group for admin
Route::group([
    // 'prefix' => 'admin', 'as' => 'admin.'
], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::resource('/users', 'App\Http\Controllers\UserController');
    // write route for available-jobs
    Route::resource('/candidates', 'App\Http\Controllers\CandidateController');

    Route::resource('/available', 'App\Http\Controllers\AvailableJobController');

    Route::resource('/jobapply', 'App\Http\Controllers\JobApplyController');
    Route::resource('/interview', 'App\Http\Controllers\InterviewController');
    Route::resource('/interviewreview', 'App\Http\Controllers\InterviewReviewController');
    Route::resource('/jobcandidate', 'App\Http\Controllers\JobCondidateController');
    
});