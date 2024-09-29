<?php

namespace App\Workers;

use App\Services\NotifyService;

class CronWorker
{
    public static function work(): void
    {
        NotifyService::handle();
    }
}