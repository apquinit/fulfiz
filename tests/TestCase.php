<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp() : void
    {
        parent::setUp();  

        config(['app.dialogflow.irene_lite' => 'irene-lite-vbvypr']);
        config(['app.dialogflow.irene' => 'irene-4fe98']);

        config(['services.location_iq.base_url' => 'https://us1.locationiq.com/v1/search.php']);
        config(['services.location_iq.api_key' => '4c53f82e708066']);
        
        config(['services.timezone_db.base_url' => 'https://api.timezonedb.com/v2.1/get-time-zone']);
        config(['services.timezone_db.api_key' => '0RPFRW3KR7BJ']);

        config(['services.dark_sky.base_url' => 'https://api.darksky.net/forecast']);
        config(['services.dark_sky.api_key' => '5a050170535218d28b85e8cad4e6f781']);

        config(['services.wolfram_alpha.base_url' => 'https://api.wolframalpha.com/v1/result']);
        config(['services.wolfram_alpha.api_key' => 'ETLETX-AHJPWUWGQ4']);

        config(['services.pushbullet.base_url' => 'https://api.pushbullet.com/v2']);
        config(['services.pushbullet.api_key' => 'o.6W7oRgL4xzqeOVHJrnFE9CObQOBlGCBy']);
    }
}
