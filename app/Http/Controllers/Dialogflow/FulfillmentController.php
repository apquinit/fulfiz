<?php

namespace App\Http\Controllers\Dialogflow;

use Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FulfillmentController extends Controller
{
    private $request;
    private $service;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function __invoke()
    {
        // Resolve fulfillment service interface from container
        $this->service = resolve('App\Interfaces\DialogflowFulfillmentServiceInterface');

        // Pass parameters array to setParameters()
        if ($this->request->agent->getAction() === 'default.fallback') {
            $parameters = [
                'query' => $this->request->agent->getQuery()
            ];
            $this->service->setParameters($this->request->user, $parameters);
        } else {
            $this->service->setParameters($this->request->user, $this->request->agent->getParameters());
        }

        // Execute process and generate a text response
        $this->service->process();

        // Get generated text response property
        $textResponse = $this->service->getTextResponse();

        // Pass text response to agent->reply() method
        $this->request->agent->reply($textResponse);

        // Log request and response data
        Log::info('Dialogflow request', ['Session' => $this->request->agent->getSession(), 'Query' => $this->request->agent->getQuery(), 'Intent' => $this->request->agent->getIntent(), 'Action' => $this->request->agent->getAction(), 'Parameters' => $this->request->agent->getParameters(), 'Response' => $this->request->agent->render()]);

        // Return response to Dialogflow
        return response()->json($this->request->agent->render());
    }
}
