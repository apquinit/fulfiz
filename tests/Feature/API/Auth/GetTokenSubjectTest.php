<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Laravel\Lumen\Testing\WithoutMiddleware;

class GetTokenSubjectTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp() : void
    {
        parent::setUp();
        $this->token = $this->getToken();
    }

    /** @test */
    public function get_token_subject_endpoint_should_return_user_id_when_token_is_valid()
    {
        $response = $this->get('/auth/token/decode/subject', ['HTTP_Authorization' => 'Bearer ' . $this->token]);
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            "user_id",
        ]);
    }

    /** @test */
    public function get_token_subject_endpoint_should_return_error_400_when_token_is_invalid()
    {
        $invalid_token = 'invalid_token';
        $response = $this->get('/auth/token/decode/subject', ['HTTP_Authorization' => 'Bearer ' . $invalid_token]);
        $response->assertResponseStatus(400);
        $response->seeJsonStructure([
            "error",
        ]);
    }

    protected function getToken()
    {
        $user = factory(App\Models\User::class)->create(
            [
                "username" => 'test_user',
                "password" => app('hash')->make('test_password'),
            ]
        );

        $response = $this->post('/auth/token', ['username' => 'test_user', 'password' => 'test_password']);
        $content = json_decode($response->response->getContent());
        $token = $content->auth->token;

        return $token;
    }
}
