<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PushbulletHelperTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function push_note_to_channel_should_return_response_code_when_passed_channel_and_title_and_message()
    {
        $responseArray = push_note_to_channel('irene-test', 'Unit Test', 'This is a test message.');

        $this->assertTrue(array_key_exists('message', $responseArray));
        $this->assertTrue(array_key_exists('code', $responseArray));
    }
}
