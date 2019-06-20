<?php

use App\Services\External\AutoRemoteService;

class AutoRemoteServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->autoRemoteService = new AutoRemoteService;
    }

    /** @test */
    public function AutoRemoteService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\External\AutoRemoteService::class));
    }

    /** @test */
    public function sendMessage_method_should_return_OK_when_passed_a_message()
    {
        $statusCode = $this->autoRemoteService->sendMessage('TEST');

        $this->assertTrue($statusCode === 200);
    }
}
