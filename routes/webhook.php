<?php

$router->post('webhook', ['uses' => 'WebhookController@handle', 'middleware' => 'jwt.auth']);