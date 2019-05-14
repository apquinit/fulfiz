<?php

use App\Http\Controllers\AuthController;
use App\Services\Auth\AuthService;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Mockery as Mockery;

class AuthControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->request = Mockery::mock('Illuminate\Http\Request');
        $this->authService = new AuthService;
        $this->userRepository = Mockery::mock('App\Repositories\UserRepository');
        $this->userService = new UserService($this->userRepository);
        $this->authController = new AuthController($this->request, $this->authService, $this->userService);;
    }

    /** @test */
    public function AuthController_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Http\Controllers\AuthController::class));
    }
}
