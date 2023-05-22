<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'HomeController@index')->name('home');
// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/about', 'HomeController@about')->name('about');
Route::get('/faq', 'HomeController@faq')->name('faq');

Route::get('/contact', 'HomeController@contact')->name('contact');
Route::post('contact-store', 'SubscriptionController@contactStore')->name('contact.store');

Auth::routes();
Route::get('login', 'Auth\LoginController@index')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@index')->name('register');
Route::post('post-register', 'Auth\RegisterController@postRegister')->name('post-register');
Route::get('otp-authentication', 'Auth\RegisterController@otpAuthentication')->name('otp-authentication');
Route::post('verify-otp-authentication', 'Auth\RegisterController@verifyOtpAuthentication')->name('verify-otp-authentication');
Route::get('resend-otp-authentication', 'Auth\RegisterController@resendOtpAuthentication')->name('resend-otp-authentication');

Route::post('email-subscription', 'SubscriptionController@emailSubscribes')->name('email-subscription');
Route::get('subscription/verify/{token}','SubscriptionController@verifyEmailSubscribes')->name('verify.email.subscription'); 

Route::post('subscribe/news', 'SubscriptionController@subscribeNews')->name('subscribe.news');
Route::get('subscribe/news/verify/{token}','SubscriptionController@verifysubscribeNews')->name('subscribe.news.verify'); 

Route::get('web3projects','ProjectController@index')->name('web3projects'); 
Route::get('presskit','PresskitController@index')->name('presskit'); 

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
});

// Clear all cache
Route::get('/clear', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('clear-compiled');
    dd("Cache is cleared");
});

// topdev -- 2023-4-3 --
Route::get('admin/getuser','DashboardController@getUser'); 

Route::get( '/{any}', function () {
    return view('app');
})->where('any', '.*');
