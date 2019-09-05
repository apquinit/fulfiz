<?php

namespace App\Http\Controllers\Ifttt;

use Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function __invoke()
    {
        // Log request and response data
        Log::info('IFTTT request', ['Request Type' => 'Check Status', 'Request ID' => $this->request->header('X-Request-ID')]);

        // Return response to IFTTT
        return response(['data' => [
            'message' => 'success'
            ]
        ], 200)->header('Content-Type', 'application/json;charset=UTF-8');
    }
}
