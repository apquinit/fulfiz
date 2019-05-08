<?php

$router->get('/version', function () use ($router) {
    return $router->app->version();
});
