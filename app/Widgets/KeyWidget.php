<?php

namespace App\Widgets;

use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use  App\Models\Key;

class KeyWidget extends Widget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = Key::count();
        
        if ($count > 1) {
            $string = 'Keys';
        } else {
            $string = 'Key';
        }

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-key',
            'title'  => "{$count} {$string}",
            'text'   => "Click the button below to view all keys.",
            'button' => [
                'text' => "View",
                'link' => route('voyager.keys.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/03.jpg'),
        ]));
    }
}
