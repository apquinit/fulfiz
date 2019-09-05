<?php

namespace App\Services\Ifttt\Actions;

use App\Repositories\DeviceRepository;

class PushNotificationActionService extends IftttActionService
{
    private $deviceRepository;

    public function __construct(DeviceRepository $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }

    public function setParameters(array $parameters) : void
    {
        $this->parameters = $parameters;
    }

    public function getArrayResponse() : array
    {
        return $this->arrayResponse;   
    }

    public function process() : void
    {
        $deviceCode = $this->parameters['device_code'];
        $title = $this->parameters['title'];
        $message = $this->parameters['message'];

        // Get device
        $device = $this->deviceRepository->getByCode($deviceCode);

        if ($device->status === 'ENABLED') {
            // Set channel
            $channel = config('services.pushbullet.channel');
            if (empty($channel)) {
                abort(500, 'Internal server error.');
            } else {
                // Push notification
                $this->arrayResponse = [
                    'id' => $device->user_id,
                    'pushbullet' => push_note_to_channel($channel, $title, $message)
                ];
            }
        } elseif ($device->status === 'DISABLED') {
            abort(403, 'Device disabled.');
        } else {
            abort(500, 'Internal server error.');
        }

        return;
    }
}
