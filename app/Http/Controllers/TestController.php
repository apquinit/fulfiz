<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function test()
    {
        // Dark Sky Current
        // return (new \App\Services\DarkSkyService)->getCurrentWeather('14.5906216', '120.9799696');

        // Dark Sky Daily
        // return (new \App\Services\DarkSkyService)->getCurrentWeather('14.5906216', '120.9799696', 2019-05-19T12:00:00+08:00);

        // Location IQ
        // return (new \App\Services\LocationIQService)->getLatitudeAndLongitude('Manila');

        return 'Test Endpoint';
    }
}
