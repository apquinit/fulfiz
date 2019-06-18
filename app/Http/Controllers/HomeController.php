<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;

class HomeController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function show()
    {
        Log::info('User successfully accessed Home page');
        return view('home', ['appName' => config('app.name')]);
    }
}
