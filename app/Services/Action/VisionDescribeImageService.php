<?php

namespace App\Services\Action;

use App\Interfaces\ActionServiceInterface;
use App\Services\External\CaptionBotService;

class VisionDescribeImageService implements ActionServiceInterface
{
    private $imageUrl;

    public function __construct($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    public function getTextResponse()
    {
        // 1. Get image caption result from Caption Bot Service.
        $imageCaption = $this->getImageCaptionFromCaptionBotService();
        $textResponse = $imageCaption;

        return $textResponse;
    }

    private function getImageCaptionFromCaptionBotService()
    {
        $captionBotService = new CaptionBotService;
        
        return $captionBotService->getImageCaption($this->imageUrl);
    }
}
