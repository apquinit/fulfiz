<?php

use App\Services\External\CaptionBotService;

class CaptionBotServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->captionBotService = new CaptionBotService;
    }

    /** @test */
    public function CaptionBotService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\External\CaptionBotService::class));
    }

    /** @test */
    public function getImageCaption_method_should_return_image_description_when_passed_an_image_url()
    {
        $imageCaption = $this->captionBotService->getImageCaption('https://upload.wikimedia.org/wikipedia/commons/thumb/3/37/African_Bush_Elephant.jpg/800px-African_Bush_Elephant.jpg');
        $this->assertTrue(is_string($imageCaption));
    }
}
