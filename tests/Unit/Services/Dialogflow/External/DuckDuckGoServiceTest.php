<?php

use App\Services\Dialogflow\External\DuckDuckGoService;

class DuckDuckGoServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->duckDuckGoService = new DuckDuckGoService;
    }

    /** @test */
    public function DuckDuckGoService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\Dialogflow\External\DuckDuckGoService::class));
    }

    /** @test */
    public function getInstantAnswer_method_should_return_wiki_answer_when_passed_a_topic()
    {
        $instantAnswer = $this->duckDuckGoService->getInstantAnswer('Sherlock Holmes');
        $this->assertTrue(array_key_exists('AbstractText', $instantAnswer));
    }
}
