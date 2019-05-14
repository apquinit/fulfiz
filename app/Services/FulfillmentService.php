<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Services\Action\WeatherService;

class FulfillmentService
{
    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getfulfillmentText(Request $request)
    {
        return $request['queryResult']['action'];
    }
}
