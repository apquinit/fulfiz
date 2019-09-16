<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use App\Repositories\DeviceRepository;
use App\Repositories\UserRepository;

class GetUserAndDeviceFromDialogflowSession
{
    private $userRepository;
    private $deviceRepository;

    public function __construct(UserRepository $userRepository,DeviceRepository $deviceRepository)
    {
        $this->userRepository = $userRepository;
        $this->deviceRepository = $deviceRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $session = $request->agent->getSession();

        if (isset($request['originalDetectIntentRequest']['payload']['source']) and $request['originalDetectIntentRequest']['payload']['source'] === 'facebook') {
            if (strpos($session, config('app.dialogflow.irene_lite')) !== false) {
                $userId = config('app.dialogflow.irene_lite');
                $deviceCode = 'irene-lite-messenger';
                Log::info('Get user and device from session', ['Session' => $session, 'Source' => 'Facebook', 'User' => $userId, 'Device' => $deviceCode]);
            } elseif (strpos($session, config('app.dialogflow.irene')) !== false) {
                // Get Facebook user PSID
                $psid = $request['originalDetectIntentRequest']['payload']['data']['sender']['id'];
                $userName = get_facebook_graph_user_name($psid);
                // Get User
                $user = $this->userRepository->getByUserName($userName);
                $userId = $user->id;
                // Get Device
                $device = $this->deviceRepository->getByUserId($user->id);
                $deviceCode = $device->code;
                Log::info('Get user and device from session', ['Session' => $session, 'Source' => 'Facebook', 'User' => $userId, 'Device' => $deviceCode]);
            }
        } else {
            $device = $this->deviceRepository->getByCode($session);
            if ($device->status === 'ENABLED') {
                $userId = $device->user_id;
                $deviceCode = $device->code;
                Log::info('Get user and device from session', ['Session' => $session, 'Source' => $device->name, 'User' => $userId, 'Device' => $deviceCode]);
            } elseif ($device->status === 'DISABLED') {
                abort(403, 'Device disabled.');
            } else {
                abort(500, 'Internal server error.');
            }
        }

        $request->user = [
            'id' => $userId,
            'device_code' => $deviceCode
        ];

        return $next($request);
    }
}
