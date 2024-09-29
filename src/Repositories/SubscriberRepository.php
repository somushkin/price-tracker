<?php

namespace App\Repositories;

use App\Models\AbstractModel;
use App\Models\SubscriberModel;

class SubscriberRepository extends AbstractRepository
{
    public static string $model = SubscriberModel::class;

    public static function findByEmail(string $email): ?AbstractModel
    {
        return static::first(['email' => $email]) ?? null;
    }
}