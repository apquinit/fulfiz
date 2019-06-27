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

        if (strpos($session, 'irene-lite-vbvypr') !== false) {
            $user = 'irene-lite-vbvypr';
            Log::info('Bind session to device', ['Session' => $session, 'Device' => 'Irene Lite Messenger']);
        } elseif(strpos($session, 'irene-4fe98') !== false) {
            $user = 'irene-4fe98';
            Log::info('Bind session to device', ['Session' => $session, 'Device' => 'Irene Messenger']);
        } else {
            $device = $this->deviceRepository->getByCode($session);
            $user = $device->user_id;
            Log::info('Bind session to device', ['Session' => $session, 'Device' => $device->name]);
        }

        $request->user = [
            'id' => $user
        ];

        return $next($request);
    }
}
