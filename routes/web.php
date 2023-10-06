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
Route::post('web3projects/getlist','ProjectController@getlist')->name('web3projects.getlist');

Route::get('presskit','PresskitController@index')->name('presskit');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
});

// manually run
Route::get('/cron/script/{slug}','CronController@scriptName')->middleware(['auth']);

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
Route::get('admin/getTestUser', 'DashboardController@getTestUser');

// Api Routes
Route::get('admin/api/getNetworks', 'API\WalletController@getNetworks');
Route::get('admin/api/getNetworkWallets/{network_id}', 'API\WalletController@getNetworkWallets');
Route::post('admin/api/saveUserWallet', 'API\WalletController@saveUserWallet');
Route::get('admin/api/getUserNetworkWallets/{network_id}', 'API\WalletController@getUserNetworkWallets');
Route::get('admin/api/deleteUserWallet/{wallet_id}', 'API\WalletController@deleteUserWallet');
Route::get('admin/api/getAddedUserWallets', 'API\WalletController@getAddedUserWallets');

Route::get('admin/api/getAllProjects', 'API\WalletConnectionController@getAllProjects');
Route::post('admin/api/filterNetworkProjects', 'API\WalletConnectionController@filterNetworkProjects');
Route::post('admin/api/getCryptoRates', 'API\WalletConnectionController@getCryptoRates');

Route::get('admin/api/getAllServers', 'API\WalletConnectionController@getAllServers');

Route::post('admin/api/cardPayment', 'API\WalletConnectionController@cardPayment');
Route::post('admin/api/walletPayment', 'API\WalletConnectionController@walletPayment');
Route::get("admin/api/getUserTransaction", "API\WalletConnectionController@userTransaction");

Route::post('admin/api/purchaseServer', 'API\WalletConnectionController@purchaseServer');
Route::get('admin/api/getWalletList', 'API\WalletConnectionController@getWalletList');

Route::get('admin/api/getChainList', 'API\WalletConnectionController@getChainlist');
Route::get('admin/api/getInitialNode', 'API\WalletConnectionController@getInitialNode');

Route::post('admin/api/createNode', 'API\WalletConnectionController@createNode');
Route::get('admin/api/checkeInstalledWallets', 'API\WalletConnectionController@checkeInstalledWallets');

Route::post('admin/api/userWallet/edit', 'API\WalletConnectionController@editUserWallet');

// NYM APIs
Route::get('api/nym/getInitialNode', 'API\NYMController@getInitialNode');

// nodes
Route::get('admin/api/get-node-projects', 'API\ProjectController@getNodeProjects');
Route::post('admin/api/get-project-nodes', 'API\NodeController@getProjectNodes');
Route::get('admin/api/project-detail/{name}', 'API\ProjectController@getProjectDetail');
Route::post('admin/api/update-node', 'API\NodeController@updateNode');

Route::get( '/{any}', function () {
    return view('app');
})->where('any', '.*');

