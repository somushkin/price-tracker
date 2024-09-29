<?php

namespace App\Models;


class LinkSubscriberModel extends AbstractModel
{
    public static string $table = 'links_subscribers';

    public function __construct($data = [])
    {
        $this->modifiedFields = $data;
    }
}