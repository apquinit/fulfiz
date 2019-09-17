<?php

namespace App\Repositories;

use App\Models\Device;
use Illuminate\Database\Eloquent\Collection;

class DeviceRepository extends Repository
{
    public function getByCode(string $code) : Device
    {
        return Device::where('code', $code)->firstOrFail();
    }

    public function getAllDevicesByUserId(int $userId) : Collection
    {
        return Device::select('name', 'code')->where('user_id', $userId)->where('status', 'ENABLED')->get();
    }
}
