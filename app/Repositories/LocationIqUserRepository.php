<?php

namespace App\Repositories;

use App\Models\LocationIqUser;

class LocationIqUserRepository extends Repository
{
    public function getByUserId(int $userId) : LocationIqUser
    {
        return LocationIqUser::where('user_id', $userId)->firstOrFail();
    }
}
