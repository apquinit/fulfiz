<?php

namespace App\Services\Dialogflow;

use App\Interfaces\DialogflowFulfillmentServiceInterface;

class DeviceSmartphonePlayRandomMusicOnSpotifyFulfillmentService extends DialogflowFulfillmentService implements DialogflowFulfillmentServiceInterface
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
        $responseCode = send_autoremote_message($this->user['device_code'], 'PLAY RANDOM MUSIC ON SPOTIFY');

        if ($responseCode === 200) {
            $textResponseArray = ['Okay.', 'Sure!', 'Got it.', 'Playing music on Spotify.', 'Okay. Playing music on Spotify.', 'Sure! Playing music on Spotify.', 'Got it. Playing music on Spotify.'];
            $textResponseIndex = array_rand($textResponseArray);
            $this->textResponse = $textResponseArray[$textResponseIndex];
        } else {
            $this->textResponse = 'An error occured while I\'m trying to access your smartphone.';
        }

        return;
    }
}
