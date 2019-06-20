<?php

use App\Services\Tasker\NotifyLocationService;

class NotifyLocationServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->notifyLocationService = new NotifyLocationService('arrived.home');
    }

    /** @test */
    public function NotifyLocationService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\Tasker\NotifyLocationService::class));
    }
}
