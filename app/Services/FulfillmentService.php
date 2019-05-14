<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Factories\ActionFactory;

class FulfillmentService
{
    /**
     * Action factory.
     *
     * @var string
     */
    private $actionFactory;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(ActionFactory $actionFactory)
    {
        $this->actionFactory = $actionFactory;
    }

    public function getFulfillmentText(Request $request)
    {
        $actionService = $this->actionFactory->mapActionToService($request);
        $fulfillmentText = $actionService->getTextResponse();
        
        return $fulfillmentText;
    }
}
