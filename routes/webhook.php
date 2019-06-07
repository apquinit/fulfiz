<?php

// Webhook Routes

$router->group(['prefix' => 'webhook'], function () use ($router) {
    $router->post('dialogflow', ['uses' => 'WebhookController@dialogflow', 'middleware' => 'jwt.auth']);    
});
