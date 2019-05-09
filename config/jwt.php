<?php

return [
    'lifetime' => env('JWT_LIFETIME', 60),
    'key' => env('JWT_KEY', getenv('JWT_KEY') ? null : null),
];
