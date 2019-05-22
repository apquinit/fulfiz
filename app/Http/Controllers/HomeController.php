<?php

namespace App\Http\Controllers;

use App\Services\HomeService;

class HomeController extends Controller
{
    private $homeService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function show()
    {
        return view('home', ['app_name' => $this->homeService->getAppNameFromConfigurationFile()]);
    }
}
