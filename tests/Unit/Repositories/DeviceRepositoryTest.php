<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\DeviceRepository;

class DeviceRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->deviceRepository = new DeviceRepository;
    }

    /**
     * @test
     */
    public function getByCode_method_should_return_device_object_when_passed_device_code()
    {
        factory(\App\Models\Device::class)->create(
            [
                'code' => 'testCode',
            ]
        );

        $device = $this->deviceRepository->getByCode('testCode');

        $this->assertTrue($device instanceof \App\Models\Device);
    }
}
