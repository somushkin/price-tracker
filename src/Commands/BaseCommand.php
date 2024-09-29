<?php

namespace App\Commands;

use App\Helpers\DBHelper;

class BaseCommand
{
    protected ?DBHelper $db = null;

    public function setDb(DBHelper $db)
    {
        $this->db = $db;
    }
}