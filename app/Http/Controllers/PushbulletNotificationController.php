<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PushbulletNotificationController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function __invoke()
    {
        // Get request content
        $content = json_decode($this->request->getContent());

        // Check channel
        if (empty($content->channel)) {
            abort(400, 'Channel is required.');
        }

        // Check title
        if (empty($content->title)) {
            abort(400, 'Title is required.');
        }

        // Check message
        if (empty($content->message)) {
            abort(400, 'Message is required.');
        }

        // Return response
        $data = push_note_to_channel($content->channel, $content->title, $content->message);

        return response(['data' => $data], 200)->header('Content-Type', 'application/json;charset=UTF-8');

    }
}
