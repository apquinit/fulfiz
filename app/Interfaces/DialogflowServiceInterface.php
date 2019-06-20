<?php

namespace App\Interfaces;

use Dialogflow\WebhookClient;

interface DialogflowServiceInterface
{
    public function process() : WebhookClient;
}
