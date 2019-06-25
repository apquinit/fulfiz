<?php

namespace App\Repositories;

use App\Models\Key;

class KeyRepository extends Repository
{
    public function getByNameAndStatus(string $name, string $status) : Key
    {
        return Key::where('name', $name)
            ->where('status', $status)
            ->firstOrFail();
    }
}
