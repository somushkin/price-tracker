<?php

namespace App\Commands;

use App\Services\NotifyService;

class CheckCommand extends BaseCommand
{
    public function __invoke($arg = '')
    {
        NotifyService::handle();
    }
}