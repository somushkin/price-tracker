<?php

namespace App\Controllers;

use App\Http\Request;

class IndexController
{

    public function __construct(
        protected Request $request
    )
    {

    }
}