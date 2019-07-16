<?php

namespace App\Repositories;

use App\Models\DarkSkyUser;

class DarkSkyUserRepository extends Repository
{
    public function getByUserId(int $userId) : DarkSkyUser
    {
        return DarkSkyUser::where('user_id', $userId)->firstOrFail();
    }
}
