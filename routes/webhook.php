<?php

$router->post('webhook', ['uses' => 'WebhookController@handle']);