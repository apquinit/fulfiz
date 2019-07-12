<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use App\Repositories\DeviceRepository;

class BindSessionToDevice
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
            Log::info('Bind session to device', ['Session' => $session, 'Device' => 'Irene Lite Messenger']);
        } elseif (strpos($session, config('app.dialogflow.irene')) !== false) {
            $user = config('app.dialogflow.irene');
            Log::info('Bind session to device', ['Session' => $session, 'Device' => 'Irene Messenger']);
        } else {
            $device = $this->deviceRepository->getByCode($session);
            if ($device->status === 'ENABLED') {
                $user = $device->user_id;
                Log::info('Bind session to device', ['Session' => $session, 'Device' => $device->name]);
            } elseif ($device->status === 'DISABLED') {
                abort(401, 'Device Disabled');
            } else {
                abort(500, 'Internal Server Error');
            }
        }

        $request->user = [
            'id' => $user
        ];

        return $next($request);
    }
}
