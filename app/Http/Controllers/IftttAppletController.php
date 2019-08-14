<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\DeviceRepository;

class IftttAppletController extends Controller
{
    private $request;
    private $userRepository;
    private $deviceRepository;

    public function __construct(Request $request, DeviceRepository $deviceRepository, UserRepository $userRepository)
    {
        $this->request = $request;
        $this->userRepository = $userRepository;
        $this->deviceRepository = $deviceRepository;
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
        // $deviceCode = config('app.dialogflow.irene');
        $deviceCode = 'uvLPoqMf';

        // Add value to data array
        $data = [
            'samples' => [
                'actions' => [
                    'arrived_home' => [
                        'device_code' => $deviceCode
                    ]
                ]
            ],
        ];

        // Return response to IFTTT
        return response(['data' => $data], 200)->header('Content-Type', 'application/json;charset=UTF-8');
    }

    public function actionArrivedHome()
    {
        // Get device code
        $deviceCode = $this->request->actionFields['device_code'];

        // Get device user
        $device = $this->deviceRepository->getByCode($deviceCode);

        if ($device->status === 'ENABLED') {
            $userId = $device->user_id;
        } elseif ($device->status === 'DISABLED') {
            abort(403, 'Device disabled.');
        } else {
            abort(500, 'Internal server error.');
        }

        $user = $this->userRepository->getByUserId($userId);

        // Set note title and message
        $title = 'Irene';
        $message = ucwords($user->name) . ' arrived home.';

        // Push note to channel
        $status = push_note_to_channel('irene', $title, $message);

        // Return response
        return response($status['code'])->header('Content-Type', 'application/json;charset=UTF-8');
    }
}
