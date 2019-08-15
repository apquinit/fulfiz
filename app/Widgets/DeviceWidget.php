<?php

namespace App\Widgets;

use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use  App\Models\Device;

class DeviceWidget extends Widget
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
        $count = Device::count();
        
        if ($count > 1) {
            $string = 'Devices';
        } else {
            $string = 'Device';
        }

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-phone',
            'title'  => "{$count} {$string}",
            'text'   => "Click the button below to view all devices.",
            'button' => [
                'text' => "View",
                'link' => route('voyager.devices.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/02.jpg'),
        ]));
    }
}
