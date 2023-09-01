<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\SearchController;

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

Route::get('clear-cache', function () {
   $exitCode = Artisan::call('cache:clear');
   $exitCode1 = Artisan::call('config:cache');
   $exitCode2 = Artisan::call('key:generate');

     echo 'Debug completed. Thanks';
});


//receive mpesa requests

Route::prefix('request-payments')->name('request-payment.')->group(function () {
    Route::get('/', 'MPESAController@getUrlSecure')->name('data-forward');
    //       Route::get('create', 'BranchController@create')->name('create');
});

Route::get('/landing','LandingController@Landing')->name('index');
Route::post('subscribe', 'LandingController@Subscribe')->name('subscribe');
Route::get('get-subscribers', 'LandingController@getSubscribers')->name('get-subscribers');
Route::post('post-message', 'LandingController@sendMessage')->name('post-message');
Route::get('get-message', 'LandingController@getMessages')->name('get-message');
Route::post('book', 'LandingController@bookTrip')->name('book');
Route::post('confirm', 'LandingController@confirmTrip')->name('confirm');
Route::post('track', 'LandingController@trackPackage')->name('track');
Route::get('confirmed', 'LandingController@confirmedTrip')->name('confirmed');
Route::post('get-details', 'LandingController@tripDetails')->name('get-details');
Route::post('book-verify-otp', 'LandingController@bookVerifyEmail')->name('book-verify-otp');
Route::post('otp-validation-book', 'LandingController@bookVerifyOTP')->name('otp-validation-book');
Route::get('register', 'ClientsController@registerClient')->name('register');
Route::get('validation', 'ClientsController@validateOTP')->name('validation');
Route::post('self-reg', 'ClientsController@postClientSelf')->name('self-reg');
Route::post('otp-validation', 'ClientsController@postOTPValidation')->name('otp-validation');

// Route::get('', 'AuthController@index')->name('index');
Route::get('/', 'AuthController@login')->name('login');
Route::post('login', 'AuthController@processLogin')->name('post-login');
Route::get('logout', 'AuthController@logout')->name('logout');

Route::post('otp-login', 'AuthController@loginOTP')->name('otp-login');

Route::get('verify/account/{code}', 'AuthController@verify')->name('verify-account');
Route::post('set-password', 'AuthController@setPassword')->name('set-password');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', 'SystemAdminController@index')->name('dashboard');

    Route::get('sample-upload', 'UploadController@downloadSample')->name('sample-upload');

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', 'SettingsController@index')->name('profile');
        Route::post('upload-avatar', 'SettingsController@create')->name('upload-avatar');
        Route::post('change-password', 'SettingsController@changePassword')->name('change-password');
    });

    Route::prefix('permissions')->name('permissions.')->group(function () {
        Route::get('/', 'PermissionController@index')->name('index');
    });

    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', 'RoleController@index')->name('index');
        Route::get('create', 'RoleController@create')->name('create');
        Route::post('create', 'RoleController@store');
        Route::get('edit/{role}', 'RoleController@edit')->name('edit');
        Route::post('edit/{role}', 'RoleController@update');
        Route::get('show/{role}', 'RoleController@show')->name('show');
    });
    Route::prefix('clients')->name('client.')->group(function () {
        Route::get('clients', 'ClientsController@showClients')->name('clients');
        Route::get('create', 'ClientsController@create')->name('create');
        Route::post('add-employee', 'ClientsController@postClient')->name('submit');
        Route::get('get-employees', 'ClientsController@showEmployees')->name('get-employees');

    });
    Route::prefix('riders')->name('rider.')->group(function () {
        Route::get('riders', 'RidersController@showRiders')->name('riders');
        Route::get('create', 'RidersController@create')->name('create');
        Route::post('add-rider', 'RidersController@addRider')->name('add-rider');
        Route::get('edit/{id}', 'RidersController@edit')->name('edit');
        Route::get('remove/{id}', 'RidersController@remove')->name('remove');
        Route::post('update/{id}', 'RidersController@update')->name('update');
        Route::post('assign/bike', 'RidersController@assgnBike')->name('asign-bike');
        Route::post('unassign/bike', 'RidersController@unAssignBike')->name('unassign');


    });
    //unpaid trips 
    Route::prefix('trips')->name('trip.')->group(function () {
        Route::get('index', 'TripController@index')->name('index');
        Route::post('update', 'TripController@updateTripPayment')->name('update');
        Route::get('trip-payment', 'TripController@tripPayment')->name('trip-payment');
        Route::get('list-unpaid', 'TripController@listUnpaidTrips')->name('list-unpaid');



    });

    //Rates
    Route::prefix('rates')->name('rate.')->group(function () {
        Route::get('create', 'RateController@create')->name('create');
        Route::get('list', 'RateController@index')->name('list');
        Route::post('post', 'RateController@postRates')->name('post');
        Route::get('edit/{id}', 'RateController@edit')->name('edit');
        Route::get('remove/{id}', 'RateController@remove')->name('remove');
        Route::post('update/{id}', 'RateController@update')->name('update');


    });

    //FAQs
    Route::prefix('faqs')->name('faq.')->group(function () {
        Route::get('create', 'FaqsController@createFaqs')->name('create');
        Route::get('show', 'FaqsController@showFaqs')->name('show');
        Route::post('post', 'FaqsController@addFaqs')->name('post');
        Route::get('edit/{id}', 'FaqsController@edit')->name('edit');
        Route::get('remove/{id}', 'FaqsController@remove')->name('remove');
        Route::post('update/{id}', 'FaqsController@update')->name('update');


    });

    //Feedbacks
    Route::prefix('feedbacks')->name('rider.')->group(function () {
        Route::get('feedback', 'FeedbacksController@showRiderFeedback')->name('feedback');
        Route::get('feedback-clients', 'FeedbacksController@showClientFeedback')->name('client');
    });

    //createPromo
    Route::prefix('promos')->name('promo.')->group(function () {
        Route::get('create-promo', 'PromosController@createPromo')->name('create-promo');
        Route::get('create-promo-sequential', 'PromosController@createPromoSequential')->name('create-promo-sequential');
        Route::get('verify-promo', 'PromosController@verifyPromo')->name('verify-promo');
        Route::get('retrieve-promo', 'PromosController@viewPromos')->name('retrieve-promo');
        Route::post('post-promo', 'PromosController@generatePromo')->name('post-promo');
        Route::post('post-promo-sequential', 'PromosController@generatePromoSequential')->name('post-promo-sequential');



    });

    //Payments
    Route::prefix('payments')->name('payment.')->group(function () {
        Route::get('add-payments', 'PaymentsController@getFormBalance')->name('add-payments');

    });

    //Notifications and SMS

     Route::prefix('notifications')->name('sms.')->group(function () {
         Route::get('create', 'NotificationsController@create')->name('create');
         Route::get('sent', 'NotificationsController@sentSMS')->name('sent');
         Route::get('push', 'NotificationsController@createPush')->name('push');
         Route::post('send-push', 'NotificationsController@sendPush')->name('send-push');
         Route::post('send-sms', 'NotificationsController@sendSMS')->name('send-sms');
     });



         //Deliveries/Trips
    Route::prefix('trips')->name('trip.')->group(function () {
        Route::get('delivered', 'DeliveriesController@deliveredTrips')->name('delivered');
        Route::get('on-transit', 'DeliveriesController@deliveryOnTransit')->name('on-transit');
        Route::get('disputed', 'DeliveriesController@deliveryDisputed')->name('disputed');
        Route::get('requested-trips', 'DeliveriesController@requestedTrips')->name('requested-trips');



    });

    Route::prefix('assets')->name('asset.')->group(function () {
        Route::get('all', 'AssetController@index')->name('list-bikes');
        Route::get('create-asset', 'AssetController@createBikeForm')->name('create-asset');
        Route::post('submit-bike', 'AssetController@registerBike')->name('submit-bike');
        Route::get('un-allocated', 'AssetController@unAllocated')->name('un-allocated');
        Route::get('all-branches-assets', 'AssetController@getAllBranches')->name('all-branches-assets');
        Route::get('create-branch-form', 'AssetController@createBranchForm')->name('create-branch-form');
        Route::post('branches', 'AssetController@submitBranchName')->name('branches');
        Route::get('assign-bike', 'AssetController@assignBikeForm')->name('assign-bike');
        Route::get('return-bike', 'AssetController@returnBikeForm')->name('return-bike');
        Route::post('submit-assign', 'AssetController@confirmAssignBike')->name('submit-assign');
        Route::post('submit-return', 'AssetController@confirmReturnBike')->name('submit-return');
        Route::get('fuel-form', 'AssetController@fuelForm')->name('fuel-form');
        Route::get('service-form', 'AssetController@serviceForm')->name('service-form');
        Route::post('submit-fuel-form', 'AssetController@submitFuelForm')->name('submit-fuel-form');
        Route::post('submit-service-form', 'AssetController@submitServiceForm')->name('submit-service-form');
        Route::get('fuel-history', 'AssetController@getFuelHistory')->name('fuel-history');
        Route::get('riders-history', 'AssetController@getRidersHistory')->name('riders-history');
        Route::get('service-history', 'AssetController@getServiceHistory')->name('service-history');
		Route::post('submit-asset', 'AssetController@registerAsset')->name('submit-asset');
        Route::get('create-assetForm', 'AssetController@createAssetForm')->name('create-assetForm');
        Route::get('all-assets', 'AssetController@AssetIndex')->name('list-assets');
    });
	
	Route::get('create/region', 'CorporatesController@createRegion')->name('corporate.indexRegion');
    Route::get('all/region', 'CorporatesController@region')->name('corporate.index-region');
    Route::post('add/region', 'CorporatesController@addregions')->name('corporate.add_regions');
    Route::post('add/Map', 'CorporatesController@addMap')->name('corporate.addMap');
    Route::get('Map/region', 'CorporatesController@mapRegion')->name('corporate.mapRegion');


     //Corporates
     Route::prefix('corporates')->name('corporate.')->group(function () {
        Route::get('show', 'CorporatesController@index')->name('show');
        Route::get('create', 'CorporatesController@create')->name('create');
		Route::get('show_addMap', 'CorporatesController@showAddMap')->name('showAddMap');
        
     
     
        Route::post('submit', 'CorporatesController@addCorporate')->name('submit');
        Route::get('add-admin-form', 'CorporatesController@getusersForm')->name('add-admin-form');
        Route::get('bill', 'CorporatesController@getBalance')->name('bill');
        Route::get('ride-history', 'CorporatesController@getRideHistory')->name('ride-history');
        Route::get('edit/{client_id}', 'CorporatesController@edit')->name('edit');
        Route::post('update/{client_id}', 'CorporatesController@update')->name('update');
        Route::delete('delete/{client_id}', 'CorporatesController@delete')->name('delete');
        Route::get('action/{id}', 'CorporatesController@actionCorporates')->name('action'); 
        Route::get('send-one-sms', 'CorporatesController@sendSMSToOne')->name('send-one-sms');
        Route::get('send-bulk-sms', 'CorporatesController@sendBulkSMS')->name('send-bulk-sms');
        Route::get('corporates-bulk-sms', 'CorporatesController@retrieveMessages')->name('corporates-bulk-sms');
		
		  Route::get('asssign-rider', 'CorporatesController@assignRider')->name('assignRider');
        Route::post('post-rider', 'CorporatesController@postRider')->name('postRider');
     });


    Route::prefix('members')->name('members.')->group(function () {
        Route::get('search', 'MemberController@search')->name('search');
        Route::get('pin-resets', 'MemberController@pinresets')->name('pin-resets');
        Route::post('userpin', 'MemberController@changepinUser')->name('userpin');

    });


    Route::prefix('limits')->name('limits.')->group(function () {
        Route::get('customer', 'LimitsController@customers')->name('customer');
        Route::get('create', 'LimitsController@create')->name('create');
        Route::get('limits', 'LimitsController@limits')->name('limits');
        Route::post('add', 'LimitsController@store')->name('add');
        Route::get('edit/{limit}', 'LimitsController@edit')->name('edit');
        Route::post('edit/{limit}', 'LimitsController@update');
    });


    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', 'UserController@index')->name('index');
        Route::get('create', 'UserController@create')->name('create');
        Route::post('add-users', 'UserController@store')->name('addusers');
        Route::get('reset', 'UserController@resetPassword')->name('reset');

        Route::get('edit/{user}', 'UserController@edit')->name('edit');
        Route::post('edit/{user}', 'UserController@update');

        Route::get('customer', 'UserController@customers')->name('customer');

        Route::get('show/{user}', 'UserController@show')->name('show');
        Route::post('delete/{user}', 'UserController@destroy')->name('destroy');
        Route::get('resetpassword/{user}', 'UserController@passreset')->name('reset-password');
        Route::get('logs/{user}', 'UserController@logs')->name('logs');
        Route::get('expiry', 'UserController@expiry')->name('expiry');
    });

    Route::resource('/users/deleted', 'SoftDeletesController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::prefix('uploads')->name('uploads.')->group(function () {
        Route::get('/', 'UploadController@index')->name('index');
        Route::get('create', 'UploadController@create')->name('create');
        Route::post('create', 'UploadController@processUpload');

        Route::post('approve/{upload}', 'UploadController@approveUpload')->name('approve');
        Route::post('decline/{approve}', 'UploadController@declineUpload')->name('decline');
    });

    Route::prefix('uploads')->name('uploads.')->group(function () {
        Route::get('/', 'UploadController@index')->name('index');
        Route::get('create', 'UploadController@create')->name('create');
        Route::post('create', 'UploadController@processUpload');

        Route::post('approve/{upload}', 'UploadController@approveUpload')->name('approve');
        Route::post('decline/{approve}', 'UploadController@declineUpload')->name('decline');
    });


    Route::prefix('upload')->name('bulk.')->group(function () {
        Route::get('/import', 'BulkUploadController@addBulk')->name('import');
		Route::get('import-admin', 'BulkUploadController@viewBulkAdmin')->name('import-admin');
        Route::post('savebulk', 'BulkUploadController@importProductExcel')->name('save');
        Route::get('collect', 'BulkUploadController@collectProduct')->name('collect');
		Route::get('collect-admin', 'BulkUploadController@collectProductAdmin')->name('collect-admin');
        Route::get('get', 'BulkUploadController@getParcel')->name('update-parcel');
        Route::post('process-collect', 'BulkUploadController@processCollection')->name('process-collect');
        Route::post('action-computer', 'BulkUploadController@acceptOrRejectBulkInputsComputers')->name('action-computer');
        Route::post('add-shipment', 'BulkUploadController@postParcel')->name('submit');
    });

    Route::prefix('branch')->name('branch.')->group(function () {
       Route::get('/', 'BranchController@index')->name('index');
//       Route::get('create', 'BranchController@create')->name('create');
    });

    Route::post('create', 'BranchController@store');

    Route::prefix('location')->name('location.')->group(function () {
        Route::get('/', 'LocationController@index')->name('index');
        Route::get('create', 'LocationController@create')->name('create');
        Route::post('add-location', 'LocationController@store')->name('add-location');
    });

    Route::prefix('agent-transactions')->name('agent-transactions.')->group(function () {
        Route::get('balance-inquiry', 'AgentTransactionsController@fetchBalance')->name('balance-inquiry');
        Route::post('balance', 'AgentTransactionsController@balance');
        Route::get('cash-deposit', 'AgentTransactionsController@cashDeposit')->name('cash-deposit');
        Route::post('deposit', 'AgentTransactionsController@deposit');
        Route::get('cash-withdrawal', 'AgentTransactionsController@cashWithdrawal')->name('cash-withdrawal');
        Route::post('withdrawal', 'AgentTransactionsController@withdrawal');
    });
});


//Reports
Route::prefix('reports')->name('report.')->group(function () {
    Route::get('mpesa-statements', 'ReportsController@showMpesaStatement')->name('mpesa-statements');
    Route::get('income-report', 'ReportsController@showIncome')->name('income-report');
    Route::get('completed-rides', 'ReportsController@showSuccesfulTrips')->name('completed-rides');
    Route::get('total-clients', 'ReportsController@showSuccessfulClients')->name('total-clients');
    Route::get('export', 'ReportsController@export')->name('export');
    Route::post('import', 'ReportsController@import')->name('import');
    Route::get('client', 'ReportsController@exportClient')->name('client');
    Route::get('income', 'ReportsController@exportIncome')->name('income');
    Route::get('rider', 'ReportsController@exportRider')->name('rider');
    Route::get('search', 'ReportsController@search')->name('search');
    Route::get('importExportView', 'ReportsController@importExportView')->name('importExportView');
    Route::get('export', 'ReportsController@export')->name('export');
    Route::get('statements', 'ReportsController@filterStatement')->name('statements');
    Route::get('filter-client', 'ReportsController@filterClient')->name('filter-client');
    Route::get('filter-trip', 'ReportsController@filterTrip')->name('filter-trip');
    Route::get('get-income', 'ReportsController@filterIncome')->name('get-income');
    Route::get('filter-shipment', 'ReportsController@filterShipment')->name('filter-shipment'); 
    Route::get('shipments', 'ReportsController@exportShipment')->name('shipment');  
    Route::get('all-shipments', 'ReportsController@showAllShipment')->name('all-shipments');
    Route::get('shipment', 'ReportsController@shipments')->name('shipments');
    Route::post('shipment-report', 'ReportsController@downloadShipment')->name('download-shipment');
	
	
    Route::get('payment-report', 'ReportsController@paymentExport')->name('payment-report');
    Route::get('status-report', 'ReportsController@statusExport')->name('status-report'); 
    Route::get('branch-report', 'ReportsController@branchExport')->name('branch-report'); 


    Route::get('filter-status-report', 'ReportsController@statusReport')->name('filter-status-report'); 
    Route::get('filter-payment-report', 'ReportsController@paymentReport')->name('filter-payment-report'); 
    Route::get('filter-branch-report', 'ReportsController@branchReport')->name('filter-branch-report'); 
	Route::get('filter-branch-financial-report', 'ReportsController@branchFinancialReport')->name('filter-corporate-financial-report');
	Route::get('post-branch-financial-report', 'ReportsController@CorporateFinancialReportExport')->name('post-corporate-financial-report');

 
    
   });

    //search panel and date filter
    Route::get('/findSearch', 'SearchController@findSearch')->name('findSearch');
    Route::get('/find-dates', 'FilterDatesController@filterDates')->name('filter-dates');
    Route::get('/filter-transactions', 'FilterDatesController@filterTransactions')->name('filter-transactions');
    Route::get('/filter-trips', 'FilterDatesController@filterTrips')->name('filter-trips');

    // Route::get('/', 'FilterDatesController@index') ->name('index');

    // Route::get('/findTransaction', 'SearchController@findTransaction')->name('findTransaction');
    // Route::get('/find-trip', 'SearchController@findTrip')->name('find-trip');
    // Route::post('/findSearchTrip', 'SearchController@findSearchTrip');
    // Route::get('/find-income', 'SearchController@findTrip')->name('find-income');
    // Route::post('/findSearchIncome', 'SearchController@findSearchIncome');


    Route::prefix('parcel')->name('parcel.')->group(function () {
        Route::get('shipments', 'ParcelController@showParcels')->name('index');
        Route::get('new-parcel', 'ParcelController@addParcel')->name('create');
        Route::get('calculate-price', 'ParcelController@calculatePrice')->name('price');
        Route::post('add-shipment', 'ParcelController@postParcel')->name('submit');
        Route::post('receive', 'ParcelController@sortingReceive')->name('sorting');
        Route::get('dispatch', 'ParcelController@dispatchParcel')->name('dispatch');
        Route::post('update', 'ParcelController@postDispatch')->name('update');
		Route::get('/search', 'ParcelController@search')->name('search');
		Route::get('/corporate', 'ParcelController@showParcelsCorporate')->name('corporate');
		 Route::get('/parcel', 'QRCodeController@generateQrCode')->name('generate');


      
    });
	
		
Route::get('/shipment-report-pdf/{parcel_id}', [App\Http\Controllers\PDFController::class, 'generatePDFReport'])->name('pdf');
Route::get('/shipment-Generalreport-pdf', [App\Http\Controllers\PDFController::class, 'GeneralReport'])->name('GeneralReport');

Route::get('console', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('console');

