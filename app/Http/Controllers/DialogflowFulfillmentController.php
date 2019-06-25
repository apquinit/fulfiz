<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Dialogflow\WebhookClient;
use App\Interfaces\DialogflowFulfillmentServiceInterface;

class DialogflowFulfillmentController extends Controller
{
    private $request;
    private $service;

    public function __construct(Request $request, DialogflowFulfillmentServiceInterface $service)
    {
        $this->request = $request;
        $this->fulfillmentService = $service;
    }

    public function handle()
    {        
        // Instantiate a Dialogflow Webhook client from the request
        $this->request->agent = $this->request->agent;

        // Get session/device ID from request
        // Get user based on the session/device ID

        // Pass parameters array to setParameters() 
        $this->fulfillmentService->setParameters($this->request->agent->getParameters());

        // Execute process and generate a text response
        $this->fulfillmentService->process();

        // Get generated text response property
        $textResponse = $this->fulfillmentService->getTextResponse();

        // Pass text response to agent->reply() method
        $this->request->agent->reply($textResponse);

        // Log request and response data
        Log::info('Dialogflow request', [
            'Session' => $this->request->agent->getSession(),
            'Query' => $this->request->agent->getQuery(),
            'Intent' => $this->request->agent->getIntent(),
            'Action' => $this->request->agent->getAction(),
            'Parameters' => $this->request->agent->getParameters(),
            'Response' => $this->request->agent->render()
            ]
        );

        // Return response to Dialogflow
        return response()->json($this->request->agent->render());
    }
}
