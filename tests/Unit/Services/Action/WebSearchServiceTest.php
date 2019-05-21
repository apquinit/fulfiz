<?php

use App\Services\Action\WebSearchService;

class WebSearchServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->webSearchService = new WebSearchService('Sherlock Holmes');
    }

    /** @test */
    public function WebSearchService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\Action\WebSearchService::class));
    }

    /** @test */
    public function getTextResponse_method_should_return_answer_of_type_string_when_passed_a_topic()
    {
        $textResponse = $this->webSearchService->getTextResponse();
        $this->assertTrue(is_string($textResponse));
    }
}
