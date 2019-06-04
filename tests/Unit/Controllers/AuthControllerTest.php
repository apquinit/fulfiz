<?php

class AuthControllerTest extends TestCase
{
    /** @test */
    public function AuthController_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Http\Controllers\AuthController::class));
    }
}
