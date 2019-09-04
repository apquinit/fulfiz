<?php

namespace App\Http\Controllers\Ifttt\Action;

use Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\DeviceRepository;

class ArrivedLocationController extends Controller
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

    public function __invoke()
    {
        // Log request and response data
        Log::info('IFTTT request', ['Request Type' => 'Arrived Location', 'Request ID' => $this->request->header('X-Request-ID')]);

       // Get device code
        if (empty($this->request->actionFields)) {
            abort(400, 'Bad request.');
        }

        if (empty($this->request->actionFields['device_code'])) {
            abort(400, 'Bad request.');
        }

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
        $channel = config('services.pushbullet.channel');
        $title = 'Irene';
        $message = ucwords($user->name) . ' arrived home.';

        // Push note to channel
        $pushbullet = push_note_to_channel($channel, $title, $message);

        // Return response
        return response(['data' => [
            'id' => $device->id,
            'pushbullet' => $pushbullet
            ]
        ], 200)->header('Content-Type', 'application/json;charset=UTF-8');
    }
}
