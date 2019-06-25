<?php

namespace App\Interfaces;

use App\Models\Key;

interface KeyRepositoryInterface
{
    /**
     * Get key from database by name and status.
     *
     * @var Key
     */
    public function getByNameAndStatus(string $name, string $status) : Key;
}
