<?php

use Illuminate\Http\Request;

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

Route::middleware(['dialogflow.key', 'dialogflow.session'])->prefix('dialogflow')->group(function () {
    Route::post('fulfillment', 'DialogflowFulfillmentController');
});

Route::middleware(['pushbullet.key'])->prefix('pushbullet')->group(function () {
    Route::post('notification', 'PushbulletNotificationController');
});

Route::middleware(['ifttt.key'])->prefix('ifttt')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::get('status', 'IftttAppletController@status');
        Route::post('test/setup', 'IftttAppletController@testSetup');
        Route::prefix('triggers')->group(function () {
        });
        Route::prefix('actions')->group(function () {
            Route::post('arrived_home', 'IftttAppletController@actionArrivedHome');
        });
    });
});
