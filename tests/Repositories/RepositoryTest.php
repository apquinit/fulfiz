<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\Repository;

class RepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function Repository_class_should_exist()
    {
        $this->assertTrue(class_exists(Repository::class));
    }
}
