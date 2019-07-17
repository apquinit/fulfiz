<?php

namespace App\Repositories;

use App\Models\PushbulletUser;

class PushbulletUserRepository extends Repository
{
    public function getByUserId(int $userId) : PushbulletUser
    {
        return PushbulletUser::where('user_id', $userId)->firstOrFail();
    }
}
