<?php

namespace App\Services\Dialogflow;

use App\Interfaces\DialogflowFulfillmentServiceInterface;

class DeviceSmartphoneLaunchApplicationFulfillmentService extends DialogflowFulfillmentService implements DialogflowFulfillmentServiceInterface
{
    public function setParameters(array $user, array $parameters) : void
    {
        $this->user = $user;
        $this->parameters = $parameters;
    }

    public function getTextResponse() : string
    {
        return $this->textResponse;
    }

    public function process() : void
    {
        abort(500, 'In development.');
        $responseCode = send_autoremote_message($this->user['device_code'], 'LAUNCH ' . strtoupper($this->parameters['application']));

        if ($responseCode === 200) {
            $textResponseArray = ['Okay.', 'Sure!', 'Got it.', 'Opening application.', 'Okay. Opening application.', 'Sure! Opening application.', 'Got it. Opening application.'];
            $textResponseIndex = array_rand($textResponseArray);
            $this->textResponse = $textResponseArray[$textResponseIndex];
        } else {
            $this->textResponse = 'An error occured while I\'m trying to access your smartphone.';
        }

        return;
    }
}
