<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\DuckDuckGoUserRepository;

class DuckDuckGoUserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->duckDuckGoUserRepository = new DuckDuckGoUserRepository;
    }

    /**
     * @test
     */
    public function DuckDuckGoUserRepository_class_should_exist()
    {
        $this->assertTrue(class_exists(DuckDuckGoUserRepository::class));
    }

    /**
     * @test
     */
    public function getByUserId_method_should_return_dauck_duck_go_user_object_when_passed_user_id()
    {
        factory(\App\Models\DuckDuckGoUser::class)->create(
            [
                'user_id' => 1,
            ]
        );

        $duckDuckGoUser = $this->duckDuckGoUserRepository->getByUserId(1);

        $this->assertTrue($duckDuckGoUser instanceof \App\Models\DuckDuckGoUser);
    }
}
