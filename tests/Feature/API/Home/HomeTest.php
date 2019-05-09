<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class HomeTest extends TestCase
{ 
    /** @test */
    public function home_endpoint_should_return_app_name()
    {
        $response = $this->get('/');
        $response->assertResponseStatus(200);
    }
}
