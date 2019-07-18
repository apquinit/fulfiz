<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Dialogflow\WebhookClient;

class PushbulletNotificationController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function __invoke()
    {
        $content = json_decode($this->request->getContent());

        if (empty($content->channel)) {
            abort(400, 'Bad Request');
        }

        if (empty($content->title)) {
            abort(400, 'Bad Request');
        }

        if (empty($content->message)) {
            abort(400, 'Bad Request');
        }

        return [
            'status' => push_note_to_channel($content->channel, $content->title, $content->message)
        ];
    }
}
