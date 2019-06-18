<?php

namespace App\Services\External;

class CaptionBotService
{
    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getImageCaption($imageUrl)
    {
        $ch = curl_init('https://captionbot.azurewebsites.net/api/messages');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['Type' => 'CaptionRequest', 'Content' => $imageUrl]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($ch);
        curl_close($ch);
        $imageCaption = json_decode($response);
        
        return $imageCaption;
    }
}
