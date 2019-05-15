<?php

use App\Services\Action\VisionDescribeImageService;

class VisionDescribeImageServiceTest extends TestCase
{
    /** @test */
    public function VisionDescribeImageService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\Action\VisionDescribeImageService::class));
    }

    /** @test */
    public function getTextResponse_method_should_return_image_description_of_type_string_when_passed_an_image_url()
    {
        $this->visionDescribeImageService = new VisionDescribeImageService('https://upload.wikimedia.org/wikipedia/commons/thumb/3/37/African_Bush_Elephant.jpg/800px-African_Bush_Elephant.jpg');
        $textResponse = $this->visionDescribeImageService->getTextResponse();
        $this->assertTrue(is_string($textResponse));
    }
}
