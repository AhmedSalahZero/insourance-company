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


Route::prefix('auth')->group(function(){
    Route::post('register','RegisterController');
    Route::post('login','LoginController')->name('login');
});

Route::middleware('auth:api')->group(function(){

    Route::get('companies/{company}/services','CompanyServicesController@index');
    Route::post('companies/{company}/services','CompanyServicesController@store');
    Route::delete('companies/{company}/services/{service}','CompanyServicesController@destroy');
    Route::delete('companies/{company}/services','CompanyServicesController@deleteAll');

    Route::get('companies/{company}/services-types','CompanyServiceTypesController@index');
    Route::post('companies/{company}/services-types','CompanyServiceTypesController@store');
    Route::delete('companies/{company}/services-types/{serviceType}','CompanyServiceTypesController@destroy');
    Route::delete('companies/{company}/services-types','CompanyServiceTypesController@deleteAll');


   // Route::get('companies/{company}/services-types','CompanyServicesTypesController');
    Route::get('services/{service}/companies','ServicesCompaniesController');

    Route::get('services/{service}/services-types','ServicesServicesTypesController');
    Route::get('services-types/{serviceType}/companies','ServicesTypesCompaniesController');
    Route::get('cars/{car}/types','CarCarsTypesController');
    # Route::get('services/{service}/services-types','ServicesServicesTypesController');

    Route::apiResources([
        'address'=>'addressController',
        'companies'=>'CompanyController',
        'services'=>'ServiceController',
        'serviceType'=>'serviceTypeController' ,
        'cars'=>'CarController' ,
        'carTypes'=>'CarTypeController',
        'liabilityLimits'=>'LiabilityLimitController',
        'quotas'=>'QuotaController',
        'quotas.features'=>'QuotaFeatureController',
        'insurances'=>'InsuranceController'
    ]);

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


