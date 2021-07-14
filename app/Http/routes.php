<?php

/*
  |--------------------------------------------------------------------------
  | Routes File
  |--------------------------------------------------------------------------
  |
  | Here is where you will register all of the routes in an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

//Route::get('/', 'DashboardController@editProfile');


/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | This route group applies the "web" middleware group to every route
  | it contains. The "web" middleware group is defined in your HTTP
  | kernel and includes session state, CSRF protection, and more.
  |
 */



Route::group(['middleware' => ['web']], function () {

    ////////////////// Main Page Routes ///////////////////

    Route::get('/', 'DashboardController@index');
    Route::get('/home', 'DashboardController@home');
    Route::get('/techs', 'DashboardController@techs');
    Route::get('/support', 'DashboardController@support');
    Route::get('/directory', 'DashboardController@techDirectory');

    ///////////////////New User Routes//////////////////////

    Route::get('/registration', 'DashboardController@registerPage');
    Route::post('/registerUser', 'UserController@register');
    Route::post('/registerUserPopup', 'UserController@registerUserPopup');

    /////////////////// View User Routes //////////////////

    Route::get('/person', 'UserController@person');
    Route::get('/person/{id}', 'UserController@person');
    Route::get('/user/{id}', 'UserController@getUserById');
    Route::get('/personBy/{id}/{coId}', 'UserController@personDetails');

    /////////////////// Update User Routes //////////////////

    Route::post('/saveEmail', 'UserController@saveEmail');
    Route::post('/savePhone', 'UserController@savePhone');
    Route::post('/updateUserProfile/{user}', 'UserController@updateUserProfile');


    /////////////////// Company Routes ///////////////////////

    Route::get('/profile', 'CompanyController@profile');
    Route::get('/profile/{id}', 'CompanyController@profile');
    Route::get('/company/{id}', 'CompanyController@preview');
    Route::post('/email/update/{id}', 'CompanyController@updateEmail');
    Route::post('/change/expiry/{id}', 'CompanyController@changeExpiry');
    Route::post('/change/interval/{id}', 'CompanyController@changeInterval');
    Route::post('/saveTechInfo/{company}/{tech}', 'CompanyController@saveTechInfo');

    /////////////////// Location Routes ///////////////////////

    Route::get('/removeLocation/{location}', 'LocationController@removeLocation');
    Route::get('/dashboard/{id}', 'LocationController@getLocationsForDashboard');
    Route::get('/update/location', 'LocationController@updateLocationForSearch');
    Route::get('/subBy/location/{id}', 'LocationController@subByLocationId');
    Route::get('/dashboard', 'LocationController@getLocationsForDashboard');
    Route::post('/saveLocation', 'LocationController@saveLocation');
    Route::post('/saveLocation/{id}', 'LocationController@saveLocation');
    Route::post('/editLocation/{location}', 'LocationController@editLocation');


    /////////////////// Subscription Routes ///////////////////////

    Route::get('/subscription', 'SubscriptionController@index');
    Route::get('/sub/by/{id}', 'SubscriptionController@subById');
    Route::get('/management', 'SubscriptionController@management');
    Route::get('/subscription/{id}', 'SubscriptionController@index');
    Route::get('/management/{id}', 'SubscriptionController@management');
    Route::get('/sub/update/{mds}/{mts}', 'SubscriptionController@updateMds');
    Route::get('/check/code/{code}', 'SubscriptionController@checkSetupCode');
    Route::post('/update/subscription/{id}/{coid}', 'SubscriptionController@updateSubscription');
    Route::post('/save/subscription/{id}', 'SubscriptionController@saveSubscription');
    Route::post('/subscriptions/{id}', 'SubscriptionController@show');
    Route::post('/delete', 'SubscriptionController@delete');


    ////////////////// Routes for Views ///////////////////////

    Route::get('/viewProfile', 'UserController@viewProfile');
    Route::get('/techPreview', 'UserController@viewProfile');


    //////////////////// Routes for PayPal ////////////////////////

    Route::get('/paypal/checkout/{id}/{rand}','PayPalController@returnFunction');
    Route::get('/adaptive/payment/{id}', 'PayPalController@adaptiveCheck');
    Route::get('/preapproval/payment/{id}', 'PayPalController@preApprovedPayment');
    Route::post('/email/paypal', 'PayPalController@preApproval');
    Route::post('/email/paypal/{id}', 'PayPalController@preApproval');

    ///////////////////// Routes For Reports /////////////////////////

    Route::get('/client/{name}/{type}/{id}', 'ReportsController@clientReportSort');
    Route::get('/report/client/{id}', 'ReportsController@clientReport');
    Route::get('/tech/{name}/{type}', 'ReportsController@techReport');
    Route::get('/report/client', 'ReportsController@clientReport');
    Route::get('/report/tech', 'ReportsController@techReport');
    Route::get('/tech/{name}', 'ReportsController@techReport');
    Route::post('/save/techrpt', 'ReportsController@saveTechRpt');
    Route::post('/search/postal', 'ReportsController@searchByZip');

    ///////////////////// Routes For Testing /////////////////////////

    Route::get('/ipn/notification', 'PayPalController@ipnUrl');
    Route::post('/ipn/notification', 'PayPalController@ipnUrl');


    // Auth routes
    Route::auth();
    Route::get('user/activation/{token}', 'UserController@activateUser')->name('user.activate');
});
