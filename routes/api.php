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

// Route::middleware('service.key')->get('/dialogflow', function (Request $request) {
//     return '$request->user()';
// });

Route::middleware('dialogflow.key')->prefix('dialogflow')->group(function () {
    Route::post('/', [
        'uses' => 'DialogflowFulfillmentController@handle'
    ])->name('dialogflow.fulfillment');
});
