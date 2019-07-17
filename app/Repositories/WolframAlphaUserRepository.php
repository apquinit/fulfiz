<?php

namespace App\Repositories;

use App\Models\WolframAlphaUser;

class WolframAlphaUserRepository extends Repository
{
    public function getByUserId(int $userId) : WolframAlphaUser
    {
        return WolframAlphaUser::where('user_id', $userId)->firstOrFail();
    }
}
