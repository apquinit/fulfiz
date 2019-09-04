<?php

namespace App\Http\Controllers\Ifttt\Test;

use Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SetupController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function __invoke()
    {
        // Log request and response data
        Log::info('IFTTT request', ['Request Type' => 'Test Setup', 'Request ID' => $this->request->header('X-Request-ID')]);

        // Mock device code and location value
        $deviceCode = config('app.device.default');
        $location = 'home';

        if (empty($deviceCode)) {
            abort(500, 'Internal server error.');
        }

        // Add value to data array
        $data = [
            'samples' => [
                'actions' => [
                    'arrived_location' => [
                        'device_code' => $deviceCode,
                        'location' => $location
                    ]
                ]
            ],
        ];

        // Return response to IFTTT
        return response(['data' => $data], 200)->header('Content-Type', 'application/json;charset=UTF-8');
    }
}
