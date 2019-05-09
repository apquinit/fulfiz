<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class GetTokenTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function get_token_endpoint_should_return_token_and_expiry_date_when_user_credentials_is_valid()
    {
        $user = factory(App\Models\User::class)->create(
            [
                "username" => 'test_user',
                "password" => app('hash')->make('test_password'),
            ]
        );

        $response = $this->post('/auth/token', ['username' => 'test_user', 'password' => 'test_password']);
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            "auth" => [
                "token",
                "expires_at",
            ]
        ]);
    }

    /** @test */
    public function get_token_endpoint_should_return_error_400_when_user_credentials_is_invalid()
    {
        $user = factory(App\Models\User::class)->create(
            [
                "username" => 'test_user',
                "password" => app('hash')->make('test_password'),
            ]
        );

        $response = $this->post('/auth/token', ['username' => 'test_user_invalid', 'password' => 'test_password_invalid']);
        $response->assertResponseStatus(400);
        $response->seeJsonStructure([
            "error",
        ]);
    }
}
