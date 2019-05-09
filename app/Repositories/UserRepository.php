<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function queryGetUserByUsername(string $username) : Builder
    {
        return User::where('username', $username);
    }
}
