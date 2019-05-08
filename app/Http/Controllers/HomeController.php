<?php

namespace App\Http\Controllers;

class ExampleController extends Controller
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

    public function getAppName()
    {
        return 'Irene Fulfillment Server (0.0.0)';
    }
}
