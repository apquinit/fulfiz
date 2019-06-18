<?php

// Webhook Routes

$router->group(['prefix' => 'webhook'], function () use ($router) {
    $router->post('dialogflow', ['uses' => 'DialogflowController@handle', 'middleware' => 'auth']);    
});
