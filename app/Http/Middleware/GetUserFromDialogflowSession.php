<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use App\Repositories\UserRepository;
use App\Repositories\DeviceRepository;

class GetUserFromDialogflowSession
{
    private $userRepository;

    public function __construct(UserRepository $userRepository, DeviceRepository $deviceRepository)
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
        
        if (strpos($session, config('app.dialogflow.irene_lite')) !== false) {
            $userId = config('app.dialogflow.irene_lite');
            $userName = 'Irene Lite';
            Log::info('Get user and device from session', ['Session' => $session, 'Source' => 'Facebook', 'User' => $userId]);
        } elseif (strpos($session, config('app.dialogflow.irene')) !== false) {
            if (isset($request['originalDetectIntentRequest']['payload']['source']) and $request['originalDetectIntentRequest']['payload']['source'] === 'facebook') {
                // Get Facebook user PSID
                $psid = $request['originalDetectIntentRequest']['payload']['data']['sender']['id'];
                $name = get_facebook_graph_user_name($psid);
                // Get User
                $user = $this->userRepository->getByUserName($name);
                $userId = $user->id;
                $userName = $user->name;
                Log::info('Get user and device from session', ['Session' => $session, 'Source' => 'Facebook', 'User' => $userId]);
            } else {
                $userId = config('app.dialogflow.irene');
                $userName = 'Irene';
                Log::info('Get user and device from session', ['Session' => $session, 'Source' => 'Facebook', 'User' => $userId]);
            }
        } else {
            $device = $this->deviceRepository->getByCode($session);
            if ($device->status === 'ENABLED') {
                $user = $this->userRepository->getByUserId($device->user_id);
                $userId = $user->id;
                $userName = $user->name;
                Log::info('Get user and device from session', ['Session' => $session, 'Source' => $device->name, 'User' => $userId]);
            } elseif ($device->status === 'DISABLED') {
                abort(403, 'Device disabled.');
            } else {
                abort(500, 'Internal server error.');
            }
        }

        $request->user = [
            'id' => $userId,
            'name' => $userName
        ];

        return $next($request);
    }
}
