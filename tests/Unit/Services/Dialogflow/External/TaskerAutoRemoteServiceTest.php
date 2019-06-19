<?php

use App\Services\Dialogflow\External\TaskerAutoRemoteService;

class TaskerAutoRemoteServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->taskerAutoRemoteService = new TaskerAutoRemoteService;
    }

    /** @test */
    public function TaskerAutoRemoteService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\Dialogflow\External\TaskerAutoRemoteService::class));
    }

    /** @test */
    public function sendMessage_method_should_return_OK_when_passed_a_message()
    {
        $statusCode = $this->taskerAutoRemoteService->sendMessage('TEST');

        $this->assertTrue($statusCode === 200);
    }
}
