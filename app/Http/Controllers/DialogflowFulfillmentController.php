<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dialogflow\WebhookClient;

class DialogflowFulfillmentController extends Controller
{
    public function handle()
    {
        return 'Fulfillment';
    }
}
