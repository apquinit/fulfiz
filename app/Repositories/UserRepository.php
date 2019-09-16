<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository
{
    public function getByUserId(int $userId) : User
    {
        return User::where('id', $userId)->firstOrFail();
    }

    public function getByUserName(string $name) : User
    {
        return User::where('name', $name)->firstOrFail();
    }
}
