<?php

namespace App\Http\Middleware;

use Closure;
use Log;

class BindSessionToDevice
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Log::info('Bind session to device', ['Session' => $request->session]);

        return $next($request);
    }
}
