<?php

use App\Services\AuthService;
use App\Models\User;
use Firebase\JWT\JWT;
use Carbon\Carbon;

class AuthServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->userId = factory(User::class)->create()->id;
        $this->authService = new AuthService;
        $payload = [
            'iss' => env('APP_NAME'),
            'sub' => $this->userId,
            'iat' => time(),
            'exp' => time() + config('jwt.lifetime') * 60,
        ];
        $this->token = JWT::encode($payload, config('jwt.key'));
    }

    /** @test */
    public function AuthService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\AuthService::class));
    }

    /** @test */
    public function jwtEncodeToken_method_should_return_encoded_token_when_passed_a_valid_user_id()
    {
        $encodedToken = $this->authService->jwtEncodeToken($this->userId);
        $this->assertEquals($encodedToken, $this->token);
    }

    /** @test */
    public function decodeTokenSubject_method_should_return_decoded_subject_when_passed_a_valid_token()
    {
        $subject = $this->authService->decodeTokenSubject($this->token);
        $this->assertTrue(is_int($subject));
    }

    /** @test */
    public function generateToken_method_should_return_token_and_expiration_date_array_when_passed_a_valid_user_id()
    {
        $token = $this->authService->generateToken($this->userId);
        $this->assertTrue(array_key_exists("token", $token) && array_key_exists("expires_at", $token));
    }
}
