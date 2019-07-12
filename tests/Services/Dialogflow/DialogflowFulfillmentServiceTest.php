<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Dialogflow\DialogflowFulfillmentService;

class DialogflowFulfillmentServiceTest extends TestCase
{
    /**
     * @test
     */
    public function DialogflowFulfillmentService_class_should_exist()
    {
        $this->assertTrue(class_exists(DialogflowFulfillmentService::class));
    }
}
