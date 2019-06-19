<?php

namespace App\Services\Dialogflow\Action;

use Dialogflow\WebhookClient;
use App\Interfaces\ActionServiceInterface;
use App\Services\Dialogflow\External\TaskerAutoRemoteService;

class LaunchSmartphoneApplicationService implements ActionServiceInterface
{
    private $agent;

    public function __construct(WebhookClient $agent)
    {
        $this->agent = $agent;
    }

    public function process() : WebhookClient
    {
        // Get parameters from agent
        $parameters = $this->agent->getParameters();

        // Launch smartphone application using Launch Smartphone Application Service.
        $responseMessage = $this->sendMessageToTaskerAutoRemoteService('LAUNCH ' . strtoupper($parameters['application']));

        // Assemble text response from response message.
        $textResponse = $this->assembleTextResponse($responseMessage);

        return $this->agent->reply($textResponse);
    }

    private function assembleTextResponse(string $responseMessage) : string
    {
        if ($responseMessage === 'OK') {
            $textResponse = 'Got it. Opening application.';   
        } else {
            $textResponse = 'Ooops! An error occured while trying to contact your smartphone.';
        }

        return $textResponse;
    }

    private function sendMessageToTaskerAutoRemoteService(string $message) : string
    {
        $taskerAutoRemoteService = new TaskerAutoRemoteService;
        
        return $taskerAutoRemoteService->sendMessage($message);
    }
}
