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
        $statusCode = $this->sendMessageToTaskerAutoRemoteService('LAUNCH ' . strtoupper($parameters['application']));

        // Assemble text response from response message.
        $textResponse = $this->assembleTextResponse($statusCode);

        return $this->agent->reply($textResponse);
    }

    private function assembleTextResponse($statusCode) : string
    {
        if ($statusCode === 200) {
            $textResponseArray = ['Okay.', 'Sure!', 'Got it.', 'Opening application', 'Okay. Opening application.', 'Sure! Opening application.', 'Got it. Opening application.'];
            $textResponse = array_rand($textResponseArray, 1);   
        } else {
            $textResponse = 'An error occured while I\'m trying to contact your smartphone.';
        }

        return $textResponse;
    }

    private function sendMessageToTaskerAutoRemoteService(string $message) : string
    {
        $taskerAutoRemoteService = new TaskerAutoRemoteService;
        
        return $taskerAutoRemoteService->sendMessage($message);
    }
}
