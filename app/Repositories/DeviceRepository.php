<?php

namespace App\Repositories;

use App\Models\Device;

class DeviceRepository extends Repository
{
    public function getByCode(string $code) : Device
    {
        return Device::where('code', $code)->firstOrFail();
    }
}
