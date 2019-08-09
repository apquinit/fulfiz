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

        // Check channel name
        if (empty($content->channel)) {
            abort(400, 'Bad Request');
        }

        // Check channel title
        if (empty($content->title)) {
            abort(400, 'Bad Request');
        }

        // Check channel message
        if (empty($content->message)) {
            abort(400, 'Bad Request');
        }

        // Return response
        return [
            'status' => push_note_to_channel($content->channel, $content->title, $content->message)
        ];
    }
}
