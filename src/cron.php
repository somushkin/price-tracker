<?php

require_once __DIR__ . '/autoload.php';

App\Workers\CronWorker::work();