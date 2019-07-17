<?php

namespace App\Repositories;

use App\Models\DuckDuckGoUser;

class DuckDuckGoUserRepository extends Repository
{
    public function getByUserId(int $userId) : DuckDuckGoUser
    {
        return DuckDuckGoUser::where('user_id', $userId)->firstOrFail();
    }
}
