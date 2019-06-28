<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\TimeZoneDbUserRepository;

class TimeZoneDbUserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->timeZoneDbUserRepository = new TimeZoneDbUserRepository;
    }

    /**
     * @test
     */
    public function TimeZoneDbUserRepository_class_should_exist()
    {
        $this->assertTrue(class_exists(TimeZoneDbUserRepository::class));
    }

    /**
     * @test
     */
    public function getByUserId_method_should_return_time_zone_db_user_object_when_passed_user_id()
    {
        factory(\App\Models\TimeZoneDbUser::class)->create(
            [
                'user_id' => 1,
            ]
        );

        $timeZoneDbUser = $this->timeZoneDbUserRepository->getByUserId(1);

        $this->assertTrue($timeZoneDbUser instanceof \App\Models\TimeZoneDbUser);
    }
}
