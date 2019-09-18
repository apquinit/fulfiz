<?php

namespace App\Http\Controllers\Ifttt;

use Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestSetupController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function __invoke()
    {
        // Get default device code
        $deviceCode = config('app.default_device.code');

        if (empty($deviceCode)) {
            abort(500, 'Internal server error.');
        }

        // Add mock values to data array
        $data = [
            'samples' => [
                'actions' => [
                    'push_notification' => [
                        'device_code' => $deviceCode,
                        'title' => 'Title',
                        'message' => 'Message',
                    ]
                ]
            ],
        ];

        // Log request and response data
        Log::info('IFTTT request', ['Request Type' => 'Test Setup', 'Request ID' => $this->request->header('X-Request-ID')]);

        // Return response to IFTTT
        return response(['data' => $data], 200)->header('Content-Type', 'application/json;charset=UTF-8');
    }
}
