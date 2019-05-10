<?php

$router->get('webhook', ['uses' => 'WebhookController@handle']);