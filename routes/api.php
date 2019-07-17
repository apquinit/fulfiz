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
    Route::post('/fulfillment', 'DialogflowFulfillmentController');
});

Route::middleware(['pushbullet.key'])->prefix('pushbullet')->group(function () {
    Route::post('/notification', 'PushbulletNotificationController');
});
