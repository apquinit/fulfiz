<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;

class IftttAppletController extends Controller
{
    private $request;
    private $deviceCode;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function status()
    {
        // Log request and response data
        Log::info('IFTTT request', ['Request Type' => 'Status Check', 'Request ID' => $this->request->header('X-Request-ID')]);

        // Return response to IFTTT
        return response()->json(['message' => 'success'], 200);
    }

    public function testSetup()
    {
        // Log request and response data
        Log::info('IFTTT request', ['Request Type' => 'Test Setup', 'Request ID' => $this->request->header('X-Request-ID')]);

        // Mock data value
        $this->deviceCode = 'test';

        // Add value to data array
        $data = [
            'samples' => [
                'actions' => [
                    'arrived_home' => [
                        'device_code' => $this->deviceCode
                    ]
                ]
            ],
        ];

        // Return response to IFTTT
        return response()->json(['data' => $data], 200, ['Content-Type' => 'application/json;charset=UTF-8']);
    }
}
