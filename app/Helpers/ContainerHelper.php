<?php

use App\Interfaces\DialogflowFulfillmentInterface;

if (!function_exists('map_action_to_service')) {

    /**
     * Resolve fulfillment services from container by actions.
     *
     * @param action
     * @return DialogflowFulfillmentInterface
     */
    function map_action_to_service(string $action) : DialogflowFulfillmentInterface
    {
        if ($action === 'datetime.current') {
            return resolve('DateTimeCurrentFulfillmentService');
        }
    }
}
