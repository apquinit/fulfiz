<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationIqHelperTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setup();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        // Create operator
        factory(\App\Models\LocationIqUser::class)->create(
            [
                'user_id' => 1
            ]
        );

        $this->assertTrue(true);
    }
}
