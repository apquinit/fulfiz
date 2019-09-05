<?php

namespace App\Http\Controllers\Ifttt\Actions;

use Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Ifttt\Actions\PushNotificationActionService;

class PushNotificationController extends Controller
{
    private $request;
    private $service;

    public function __construct(Request $request, PushNotificationActionService $service)
    {
        $this->request = $request;
        $this->service = $service;
    }

    public function __invoke()
    {
        // Get device code
        if (empty($this->request->actionFields)) {
            abort(400, 'Bad request.');
        }

        if (empty($this->request->actionFields['device_code'])) {
            abort(400, 'Bad request.');
        }

        $parameters = $this->request->actionFields;

        // Call Push Notification IFTTT Service
        $this->service->setParameters($parameters);
        $this->service->process();
        $arrayResponse = $this->service->getArrayResponse();

        // Log request and response data
        Log::info('IFTTT request', ['Request Type' => 'Arrived Location', 'Notification' => $arrayResponse,'Request ID' => $this->request->header('X-Request-ID')]);

        // Return response
        return response(['data' => $arrayResponse], 200)->header('Content-Type', 'application/json;charset=UTF-8');
    }
}
