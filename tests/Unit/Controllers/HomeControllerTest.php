<?php

class HomeControllerTest extends TestCase
{
    /** @test */
    public function HomeController_class_should_exist()
    {
        $this->assertTrue(class_exists(App\Http\Controllers\HomeController::class));
    }
}
