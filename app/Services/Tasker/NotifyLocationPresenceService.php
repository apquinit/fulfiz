<?php

namespace App\Services\Tasker;

use App\Interfaces\TaskerServiceInterface;
use App\Services\External\PushbulletService;

class NotifyLocationPresenceService implements TaskerServiceInterface
{
    private $profile;

    public function __construct(string $profile)
    {
        $this->profile = $profile;
    }

    public function process() : string
    {
        $channelTag = 'irene';
        $title = 'Irene';
        
        if ($this->profile === 'home.arrived') {
            $note = 'Paul arrived home.';
            $textResponse = $this->sendNoteToPushbulletService($channelTag, $title, $note);
        } else if ($this->profile === 'home.left') {
            $note = 'Paul left home.';
            $textResponse = $this->sendNoteToPushbulletService($channelTag, $title, $note);
        } else if ($this->profile === 'office.arrived') {
            $note = 'Paul arrived at the office.';
            $textResponse = $this->sendNoteToPushbulletService($channelTag, $title, $note);
        } else if ($this->profile === 'office.left') {
            $note = 'Paul left the office.';
            $textResponse = $this->sendNoteToPushbulletService($channelTag, $title, $note);
        }

        return $textResponse;
    }

    private function sendNoteToPushbulletService(string $channelTag, string $title, string $note) : string
    {
        $pushbulletService = new PushbulletService;
        
        $statusCode = $pushbulletService->pushNoteToChannel($channelTag, $title, $note);

        if ($statusCode === 200) {
            return 'Success.';
        } else {
            return 'Error.';
        }
    }
}
