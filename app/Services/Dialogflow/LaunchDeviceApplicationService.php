<?php

namespace App\Services\Dialogflow;

use Dialogflow\WebhookClient;
use App\Interfaces\DialogflowServiceInterface;
use App\Services\External\AutoRemoteService;

class LaunchDeviceApplicationService implements DialogflowServiceInterface
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

        // Check device
        if ($parameters['device'] === 'computer') {
            // To Do
            return $this->agent->reply('Sorry, my computer application launcher module is still in development.');
        }
        
        if ($parameters['device'] === 'smartphone') {
            // Launch smartphone application using Launch Smartphone Application Service.
            $statusCode = $this->sendMessageToAutoRemoteService('LAUNCH ' . strtoupper($parameters['application']));
        }

        // Assemble text response from response message.
        $textResponse = $this->assembleTextResponse($statusCode);

        return $this->agent->reply($textResponse);
    }

    private function assembleTextResponse(int $statusCode) : string
    {
        if ($statusCode === 200) {
            $textResponseArray = ['Okay.', 'Sure!', 'Got it.', 'Opening application.', 'Okay. Opening application.', 'Sure! Opening application.', 'Got it. Opening application.'];
            $textResponseIndex = array_rand($textResponseArray);
            $textResponse = $textResponseArray[$textResponseIndex];

            return $textResponse;
        } else {
            $textResponse = 'An error occured while I\'m trying to access your smartphone.';
            
            return $textResponse;
        }
    }

    private function sendMessageToAutoRemoteService(string $message) : string
    {
        $autoRemoteService = new AutoRemoteService;
        
        return $autoRemoteService->sendMessage($message);
    }
}
