<?php

use App\Services\HomeService;

class HomeServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->homeService = new HomeService;
    }

    /** @test */
    public function HomeService_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Services\HomeService::class));
    }

    /** @test */
    public function getAppNameFromConfigurationFile_method_should_return_app_name_from_configuration_file()
    {
        $appName = $this->homeService->getAppNameFromConfigurationFile();
        $this->assertTrue(is_string($appName));
    }
}
