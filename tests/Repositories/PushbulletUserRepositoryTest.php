<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\PushbulletUserRepository;

class PushbulletUserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->pushbulletUserRepository = new PushbulletUserRepository;
    }

    /**
     * @test
     */
    public function PushbulletUserRepository_class_should_exist()
    {
        $this->assertTrue(class_exists(PushbulletUserRepository::class));
    }

    /**
     * @test
     */
    public function getByUserId_method_should_return_pushbullet_user_object_when_passed_user_id()
    {
        factory(\App\Models\PushbulletUser::class)->create(
            [
                'user_id' => 1,
            ]
        );

        $pushbulletUserUser = $this->pushbulletUserRepository->getByUserId(1);

        $this->assertTrue($pushbulletUserUser instanceof \App\Models\PushbulletUser);
    }
}
