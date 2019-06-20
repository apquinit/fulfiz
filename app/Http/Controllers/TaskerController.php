<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use App\Services\Tasker\NotifyLocationService;

class TaskerController
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

    public function handle()
    {
        $profile = $this->mapRequestToService($this->request->profile)->process();

        Log::info('Tasker request', ['Profile' => $this->request->profile]);

        return $profile;
    }

    private function mapRequestToService(string $profile)
    {
        if ($profile === 'arrived.home' or $profile === 'left.home' or $profile === 'arrived.office' or $profile === 'left.office') {
            return new NotifyLocationService($profile);
        }
    }
}
