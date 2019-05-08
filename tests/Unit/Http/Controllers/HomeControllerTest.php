<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Http\Controllers\HomeController;
use Mockery as Mockery;

class HomeControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->homeService = Mockery::mock('App\Services\HomeService');
        $this->homeController = new HomeController($this->homeService);;
    }

    /** @test */
    public function HomeController_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Http\Controllers\HomeController::class));
    }

    /** @test */
    public function show_method_should_return_app_name_from_home_service_getAppNameFromConfigurationFile_method()
    {
        $this->homeService->allows('getAppNameFromConfigurationFile')
            ->once()
            ->andReturn(config('app.name'));

        $appName = $this->homeController->show();
        $this->assertTrue(is_string($appName));
    }
}
