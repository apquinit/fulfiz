<?php

use App\Services\Action\WebInstantAnswerService;

class WebInstantAnswerServiceTest extends TestCase
{
    /** @test */
    public function WebInstantAnswerService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\Action\WebInstantAnswerService::class));
    }

    /** @test */
    public function getTextResponse_method_should_return_answer_of_type_string_when_passed_a_topic()
    {
        $this->webInstantAnswerService = new WebInstantAnswerService('Sherlock Holmes');
        $textResponse = $this->webInstantAnswerService->getTextResponse();
        $this->assertTrue(is_string($textResponse));
    }
}
