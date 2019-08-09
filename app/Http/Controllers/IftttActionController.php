<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;

class IftttActionController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function status()
    {
        // Log request and response data
        Log::info('IFTTT request', ['Request ID' => $this->request->header('X-Request-ID')]);

        // Return response to IFTTT
        return response()->json(['success' => 'success'], 200);
    }
}
