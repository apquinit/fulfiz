<?php

use App\Services\Tasker\NotifyLocationPresenceService;

class NotifyLocationPresenceServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->notifyLocationService = new NotifyLocationPresenceService('arrived.home');
    }

    /** @test */
    public function NotifyLocationPresenceService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\Tasker\NotifyLocationPresenceService::class));
    }
}
