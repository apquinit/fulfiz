<?php

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Builder;

class UserRepositoryTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->userRepository = new UserRepository;
    }

    /** @test */
    public function UserRepository_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Repositories\UserRepository::class));
    }

    /** @test */
    public function queryGetUserByUsername_method_should_return_user_query_builder_when_passed_username()
    {
        // Create username
        factory(App\Models\User::class)->create(
            [
                'username' => 'test_operator',
                'password' => 'test_password'
            ]
        );

        $userQueryBuilder = $this->userRepository->queryGetUserByUsername('test_operator');

        $this->assertTrue($userQueryBuilder instanceof Builder);
    }

}
