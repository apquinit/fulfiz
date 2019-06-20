<?php

use App\Services\Tasker\NotifyPresenceService;

class NotifyPresenceServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->notifyLocationService = new NotifyPresenceService('arrived.home');
    }

    /** @test */
    public function NotifyPresenceService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\Tasker\NotifyPresenceService::class));
    }
}
