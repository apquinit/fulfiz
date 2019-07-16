<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\DarkSkyUserRepository;

class DarkSkyUserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->darkSkyUserRepository = new DarkSkyUserRepository;
    }

    /**
     * @test
     */
    public function DarkSkyUserRepository_class_should_exist()
    {
        $this->assertTrue(class_exists(DarkSkyUserRepository::class));
    }

    /**
     * @test
     */
    public function getByUserId_method_should_return_dark_sky_user_object_when_passed_user_id()
    {
        factory(\App\Models\DarkSkyUser::class)->create(
            [
                'user_id' => 1,
            ]
        );

        $darkSkyUser = $this->darkSkyUserRepository->getByUserId(1);

        $this->assertTrue($darkSkyUser instanceof \App\Models\DarkSkyUser);
    }
}
