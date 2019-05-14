<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FulfillmentService;
use Log;

class WebhookController extends Controller
{
    /**
     * Intent srvice instance.
     *
     * @var \App\Services\FulfillmentService
     */
    private $fulfillmentService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FulfillmentService $fulfillmentService)
    {
        $this->fulfillmentService = $fulfillmentService;
    }

    public function handle(Request $request)
    {
        Log::info($request);

        return response()->json([
            'fulfillmentText' => $this->fulfillmentService->getfulfillmentText($request),
            'source' => config('app.url'),
        ], 200);
    }
}
