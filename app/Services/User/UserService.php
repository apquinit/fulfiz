<?php

namespace App\Services\User;

use App\Repositories\UserRepository;

class UserService
{
    /**
     * User repository instance.
     *
     * @var App\Repositories\UserRepository
     */
    private $userRepository;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserByUsername(string $username)
    {
        return $this->userRepository->queryGetUserByUsername($username)->first();
    }
}
