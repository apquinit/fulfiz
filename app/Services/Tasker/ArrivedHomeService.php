<?php

namespace App\Services\Tasker;

use App\Interfaces\TaskerServiceInterface;
use App\Services\External\PushbulletService;

class ArrivedHomeService implements TaskerServiceInterface
{
    private $profile;

    public function __construct(string $profile)
    {
        $this->profile = $profile;
    }

    public function process()
    {
        
    }
}
