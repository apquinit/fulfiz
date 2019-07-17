<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\WolframAlphaUserRepository;

class WolframAlphaUserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->wolframAlphaUserRepository = new WolframAlphaUserRepository;
    }

    /**
     * @test
     */
    public function WolframAlphaUserRepository_class_should_exist()
    {
        $this->assertTrue(class_exists(WolframAlphaUserRepository::class));
    }

    /**
     * @test
     */
    public function getByUserId_method_should_return_wolfram_alpha_user_object_when_passed_user_id()
    {
        factory(\App\Models\WolframAlphaUser::class)->create(
            [
                'user_id' => 1,
            ]
        );

        $wolframAlphaUser = $this->wolframAlphaUserRepository->getByUserId(1);

        $this->assertTrue($wolframAlphaUser instanceof \App\Models\WolframAlphaUser);
    }
}
