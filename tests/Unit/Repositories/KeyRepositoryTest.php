<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\KeyRepository;

class KeyRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->keyRepository = new KeyRepository;
    }

    /**
     * @test
     */
    public function KeyRepository_class_should_exist()
    {
        $this->assertTrue(class_exists(KeyRepository::class));
    }

    /**
     * @test
     */
    public function getByCode_method_should_return_key_object_when_passed_key_name()
    {
        factory(\App\Models\Key::class)->create(
            [
                'name' => 'testName',
            ]
        );

        $key = $this->keyRepository->getByName('testName');

        $this->assertTrue($key instanceof \App\Models\Key);
    }
}
