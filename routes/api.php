<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'API\PassportAuthController@login');
Route::post('register', 'API\PassportAuthController@register');
Route::post('register-verify-otp', 'API\PassportAuthController@verifyOtpAuthentication');
Route::post('register-resend-otp', 'API\PassportAuthController@resendOtpAuthentication');

Route::group(['middleware' => ['verifyBearerToken']], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'API\PassportAuthController@details');
    });

    Route::group(['prefix' => 'blockchain'], function () {
        Route::get('/', 'API\BlockChainController@index');
    });

    Route::group(['prefix' => 'network'], function () {
        Route::get('/', 'API\NetworkController@index');
    });

    Route::group(['prefix' => 'supportedwallet'], function () {
        Route::get('/', 'API\SupportedWalletController@index');
    });

    Route::group(['prefix' => 'project'], function () {
        Route::get('/', 'API\ProjectController@index');
        Route::get('/view/{id}', 'API\ProjectController@view');
        Route::get('/wizard-setting-view/{id}', 'API\ProjectController@wizardSettingView');
    });

    Route::group(['prefix' => 'newscategory'], function () {
        Route::get('/', 'API\NewsCategoryController@index');
    });

    Route::group(['prefix' => 'news'], function () {
        Route::get('/', 'API\NewsController@index');
        Route::get('/view/{id}', 'API\NewsController@view');
    });

    Route::group(['prefix' => 'datacenter'], function () {
        Route::get('/country', 'API\DataCenterController@getCountry');
        Route::post('/view', 'API\DataCenterController@view');
        Route::get('/server-locations', 'API\DataCenterController@getServerLocations');
    });

    Route::group(['prefix' => 'wizard-setting-nym'], function () {
        Route::post('/store', 'API\WizardSettingNymController@store');
        Route::post('/view', 'API\WizardSettingNymController@view');
        Route::post('/create-server', 'API\WizardSettingNymController@createServer');
        Route::post('/delete-server', 'API\WizardSettingNymController@deleteServer');
        Route::post('/view-server', 'API\WizardSettingNymController@viewServer');
        Route::post('/node-installation-start', 'API\WizardSettingNymController@nodeInstallationStart');
    });
    Route::group(['prefix' => 'hetzner-api'], function () {
        Route::get('/all-locations', 'API\HetznerApiController@getAllLocations');
        Route::get('/all-datacenters', 'API\HetznerApiController@getAllDatacenters');
        Route::get('/all-images', 'API\HetznerApiController@getAllImages');
        Route::get('/all-networks', 'API\HetznerApiController@getAllNetworks');
        Route::get('/all-pricing', 'API\HetznerApiController@getAllPricing');
        Route::get('/all-volumes', 'API\HetznerApiController@getAllVolumes');
        Route::get('/all-isos', 'API\HetznerApiController@getAllIsos');
        Route::get('/all-server-types', 'API\HetznerApiController@getAllServerTypes');
        Route::get('/all-placement-groups', 'API\HetznerApiController@getAllPlacementGroups');

        Route::get('/project-servers/{name}', 'API\HetznerApiController@getProjectServers');
    });

    Route::group(['prefix' => 'convert-price'], function () {
        Route::post('/euro-to-usdt', 'API\ConvertPriceController@getEuroToUSDT');
        Route::get('/get-exchange-rate/euro', 'API\ConvertPriceController@getEuroExchangeRate');
    });

    Route::group(['prefix' => 'common'], function () {
        Route::post('/verify-wallet-address', 'API\CommonController@verifyWalletAddress');
    });

    // nym node apis
    Route::get('/getInitialNode', 'API\NYMController@getInitialNode');
    Route::post('/walletPayment', 'API\NYMController@walletPayment');
    Route::post('/purchaseServer', 'API\NYMController@purchaseServer');
    Route::get('/getTransaction/{hashId}', 'API\NYMController@getTransaction');
    Route::post('/addWallet', 'API\NYMController@addWallet');
    Route::post('/getNodeWallet', 'API\NYMController@getNodeWallet');
    Route::post('/save-server-id', 'API\NYMController@saveServerId');
});