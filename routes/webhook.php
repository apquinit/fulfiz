<?php

// Webhook Routes

$router->group(['prefix' => 'webhook'], function () use ($router) {
    $router->post('dialogflow', ['uses' => 'DialogflowController@handle', 'middleware' => 'auth']);
    $router->post('tasker', ['uses' => 'TaskerController@handle', 'middleware' => 'auth']);
});
