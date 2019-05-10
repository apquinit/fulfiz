<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Http\Controllers\TestController;

class TestControllerTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->testController = new TestController();
    }

    /** @test */
    public function TestController_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Http\Controllers\TestController::class));
    }

    /** @test */
    public function test_method_should_return_test_endpoint_string()
    {
        $testString = $this->testController->test();
        $this->assertEquals('Test Endpoint', $testString);
    }
}
