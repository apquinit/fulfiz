<?php

namespace App\Repositories;

use App\Models\TimeZoneDbUser;

class TimeZoneDbUserRepository extends Repository
{
    public function getByUserId(int $userId) : TimeZoneDbUser
    {
        return TimeZoneDbUser::where('user_id', $userId)->firstOrFail();
    }
}
