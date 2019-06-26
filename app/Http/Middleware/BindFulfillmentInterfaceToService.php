<?php

namespace App\Http\Middleware;

use Closure;
use Dialogflow\WebhookClient;
use App\Interfaces\DialogflowFulfillmentServiceInterface;

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
        if ($request->is('api/dialogflow/fulfillment')) {
            $agent = WebhookClient::fromData($request->json()->all());

            app()->bind(
                'App\Interfaces\DialogflowFulfillmentServiceInterface', function () use ($agent) {
                    if ($agent->getAction() === 'datetime.current') {
                        return new \App\Services\Dialogflow\DateTimeCurrentFulfillmentService;
                    } else {
                        abort(500, 'Internal Server Error');
                    }
                }
            );

            $request->agent = $agent;

            return $next($request);
        }
        
        return $next($request);
    }
}
