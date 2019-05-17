<?php

use App\Services\Action\DefaultFallbackService;

class DefaultFallbackServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->defaultFallbackService = new DefaultFallbackService('Who invented peanut butter?');
    }

    /** @test */
    public function DefaultFallbackService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\Action\DefaultFallbackService::class));
    }

    /** @test */
    public function getTextResponse_method_should_return_short_answer_of_type_string_when_passed_a_query()
    {
        $textResponse = $this->defaultFallbackService->getTextResponse();
        $this->assertTrue(is_string($textResponse));
    }
}
