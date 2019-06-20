<?php

use App\Services\External\PushbulletService;

class PushbulletServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->pushbulletService = new PushbulletService;
    }

    /** @test */
    public function PushbulletService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\External\PushbulletService::class));
    }

    /** @test */
    // public function pushNoteToChannel_method_should_return_OK_when_passed_channel_tag_and_message()
    // {
    //     $statusCode = $this->pushbulletService->pushNoteToChannel('irene', 'Test message.');

    //     $this->assertTrue($statusCode === 200);
    // }
}
