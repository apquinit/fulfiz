<?php

namespace App\Interfaces;

interface DialogflowFulfillmentInterface
{
    /**
     * Set required parameters to properties
     *
     * @var parameters
     */
    public function setParameters(array $parameters) : void;

    /**
     * Get generated text response
     *
     */
    public function getTextResponse() : string;

    /**
     * Process parameters to execute action and generate text response
     *
     */
    public function process() : void;
}
