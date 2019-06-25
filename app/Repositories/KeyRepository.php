<?php

namespace App\Repositories;

use App\Interfaces\KeyRepositoryInterface;
use App\Models\Key;

class KeyRepository extends Repository implements KeyRepositoryInterface
{
    public function getByNameAndStatus(string $name, string $status) : Key
    {
        return Key::where('name', $name)
            ->where('status', $status)
            ->firstOrFail();
    }
}
