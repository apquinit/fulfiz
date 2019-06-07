<?php

// API Routes

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->group(['prefix' => 'token'], function () use ($router) {

        $router->post('/', ['uses' => 'AuthController@getToken']);

        $router->group(['prefix' => 'decode', 'middleware' => 'jwt.auth'], function () use ($router) {
            $router->get('/', ['uses' => 'AuthController@getTokenPayload']);
        });
    });
});