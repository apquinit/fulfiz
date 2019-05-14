<?php

return [
    'lifetime' => env('JWT_LIFETIME', getenv('JWT_LIFETIME') ? null : 60),
    'key' => env('JWT_KEY', getenv('JWT_KEY') ? null : null),
];
