<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\LocationIqUserRepository;

class LocationIqUserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->locationIqUserRepository = new LocationIqUserRepository;
    }

    /**
     * @test
     */
    public function getByUserId_method_should_return_location_iq_user_object_when_passed_user_id()
    {
        factory(\App\Models\LocationIqUser::class)->create(
            [
                'user_id' => 1,
            ]
        );

        $locationIqUser = $this->locationIqUserRepository->getByUserId(1);

        $this->assertTrue($locationIqUser instanceof \App\Models\LocationIqUser);
    }
}
