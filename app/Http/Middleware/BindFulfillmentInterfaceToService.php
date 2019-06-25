<?php

namespace App\Http\Middleware;

use Closure;
use App\Interfaces\DialogflowFulfillmentServiceInterface;
use App\Services\Dialogflow\DateTimeCurrentFulfillmentService;

class BindFulfillmentInterfaceToService
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
        app()->bind(
            'App\Interfaces\DialogflowFulfillmentServiceInterface',
            'App\Services\Dialogflow\DateTimeCurrentFulfillmentService'
        );

        return $next($request);
    }
}
