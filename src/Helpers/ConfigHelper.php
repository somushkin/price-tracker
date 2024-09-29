<?php

namespace App\Helpers;

class ConfigHelper
{
    private array $config = [];

    public function __construct()
    {
        $this->config = include __DIR__ . '/../config.php';
    }

    public function get($type)
    {
        return $this->config[$type] ?? null;
    }
}