<?php

namespace App\Helpers;

class PriceHelper
{
    public static function equal(float $price1, float $price2)
    {
        return ((int)($price1 * 100) === (int)($price2 * 100));
    }
}