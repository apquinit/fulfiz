<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\UserRepository;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->userRepository = new UserRepository;
    }

    /**
     * @test
     */
    public function UserRepository_class_should_exist()
    {
        $this->assertTrue(class_exists(UserRepository::class));
    }

    /**
     * @test
     */
    public function getByUserId_method_should_return_user_object_when_passed_user_id()
    {
        factory(\App\Models\User::class)->create(
            [
                'id' => 1,
            ]
        );

        $user = $this->userRepository->getByUserId(1);

        $this->assertTrue($user instanceof \App\Models\User);
    }

    /**
     * @test
     */
    public function getByUserName_method_should_return_user_object_when_passed_user_name()
    {
        factory(\App\Models\User::class)->create(
            [
                'name' => 'test',
            ]
        );

        $user = $this->userRepository->getByUserName('test');

        $this->assertTrue($user instanceof \App\Models\User);
    }
}
