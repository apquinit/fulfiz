<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Dialogflow\WebhookClient;

class DialogflowFulfillmentController extends Controller
{
    private $request;
    private $agent;
    private $session;
    private $query;
    private $intent;
    private $action;
    private $parameters;
    private $fulfillmentService;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle()
    {        
        // Instantiate a Dialogflow Webhook client from the request
        $this->agent = WebhookClient::fromData($this->request->json()->all());

        // Store values to properties
        $this->session = $this->agent->getSession();
        $this->query = $this->agent->getQuery();
        $this->intent = $this->agent->getIntent();
        $this->action = $this->agent->getAction();
        $this->parameters = $this->agent->getParameters();

        // Get session/device ID from request
        // Get user based on the session/device ID

        // Resolve service class from action
        $this->fulfillmentService = map_action_to_service($this->action);

        // Pass parameters array to setParameters() methode
        $this->fulfillmentService->setParameters($this->parameters);

        // Call process() method to execute action and generate a text response
        $this->fulfillmentService->process();

        // Call getTextResponse() method to get generated text response property
        $textResponse = $this->fulfillmentService->getTextResponse();

        // Pass text response to agent->reply() method
        $this->agent->reply($textResponse);

        // Log request and response data
        Log::info('Dialogflow request', [
            'Session' => $this->session,
            'Query' => $this->query,
            'Intent' => $this->intent,
            'Action' => $this->action,
            'Parameters' => $this->parameters,
            'Response' => $this->agent->render()
            ]
        );

        // Return response to Dialogflow
        return response()->json($this->agent->render());
    }
}
