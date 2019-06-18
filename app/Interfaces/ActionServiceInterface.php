<?php

namespace App\Interfaces;

use Dialogflow\WebhookClient;

interface ActionServiceInterface
{
    public function process() : WebhookClient;
}
