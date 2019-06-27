<?php

namespace App\Repositories;

use App\Models\Key;

class KeyRepository extends Repository
{
    public function getByName(string $name) : Key
    {
        return Key::where('name', $name)->firstOrFail();
    }
}
