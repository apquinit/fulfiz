<?php

use App\Services\UserService;
use App\Models\User;
use Mockery as Mockery;

class UserServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->username = factory(User::class)->create()->username;
        $this->userRepository = Mockery::mock('App\Repositories\UserRepository');
        $this->userService = new UserService($this->userRepository);
    }

    public function tearDown() : void
    {
        Mockery::close();
    }

    /** @test */
    public function UserService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\UserService::class));
    }

    /** @test */
    public function getUserByUsername_method_should_return_instance_of_user_when_called()
    {
        $this->userRepository->allows('queryGetUserByUsername')
            ->with($this->username)
            ->once()
            ->andReturn(User::where('username', $this->username));

        $user = $this->userService->getUserByUsername($this->username);
        $this->assertTrue($user instanceof App\Models\User);
    }
}
