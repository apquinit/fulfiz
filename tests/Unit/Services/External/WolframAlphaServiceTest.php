<?php

use App\Services\External\WolframAlphaService;

class WolframAlphaServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->wolframAlphaService = new WolframAlphaService;
    }

    /** @test */
    public function WolframAlphaService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\External\WolframAlphaService::class));
    }

    /** @test */
    public function getShortAnswer_method_should_return_answer_when_passed_a_query()
    {
        $shortAnswer = $this->wolframAlphaService->getShortAnswer('Sherlock Holmes');
        $this->assertTrue(is_string($shortAnswer));
    }
}
