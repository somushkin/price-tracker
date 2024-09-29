<?php

namespace App\Services;

use App\Http\Request;

class AppService
{
    public static function run()
    {
        $request = new Request(
            $_SERVER['REQUEST_URI'],
            $_SERVER['REQUEST_METHOD'],
            json_decode(file_get_contents('php://input'), true)
        );

        $request->handle();
    }
}