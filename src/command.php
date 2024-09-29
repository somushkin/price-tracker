<?php

require_once __DIR__ . '/autoload.php';

use App\Helpers\DBHelper;

if (!empty($argv[1])) {

    $classHandler = 'App\Commands\\' . ucfirst($argv[1]) . 'Command';

    if (class_exists($classHandler)) {
        $command = new $classHandler();
        $command->setDb(DBHelper::getInstance());

        $arg = $argv[2] ?? null;
        $command($arg);
    }

}