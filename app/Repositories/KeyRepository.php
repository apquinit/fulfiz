<?php

namespace App\Repositories;

use App\Interfaces\KeyRepositoryInterface;
use App\Models\Key;

/**
 * Class KeyRepository.
 */
class KeyRepository implements KeyRepositoryInterface
{
    public function getByNameAndStatus(string $name, string $status) : Key
    {
        return Key::where('name', $name)
            ->where('status', $status)
            ->firstOrFail();
    }
}
