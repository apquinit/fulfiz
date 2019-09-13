<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use App\Repositories\DeviceRepository;

class GetUserAndDeviceFromDialogflowSession
{
    private $deviceRepository;

    public function __construct(DeviceRepository $deviceRepository)
    {
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
            $user = config('app.dialogflow.irene_lite');
            $code = 'irene-lite-messenger';
            Log::info('Bind session to device', ['Session' => $session, 'Device' => 'Irene Lite Messenger']);
        } elseif (strpos($session, config('app.dialogflow.irene')) !== false) {
            $user = config('app.dialogflow.irene');
            $code = 'irene-messenger';
            Log::info('Bind session to device', ['Session' => $session, 'Device' => 'Irene Messenger']);
        } else {
            $device = $this->deviceRepository->getByCode($session);
            if ($device->status === 'ENABLED') {
                $user = $device->user_id;
                $code = $device->code;
                Log::info('Bind session to device', ['Session' => $session, 'Device' => $device->name]);
            } elseif ($device->status === 'DISABLED') {
                abort(403, 'Device disabled.');
            } else {
                abort(500, 'Internal server error.');
            }
        }

        $request->user = [
            'id' => $user,
            'device_code' => $code
        ];

        return $next($request);
    }
}
