<?php

namespace App\Repositories;

use App\Models\AbstractModel;
use App\Models\LinkModel;

class LinkRepository extends AbstractRepository
{
    public static string $model = LinkModel::class;

    public static function findByProductId(string $productId): ?AbstractModel
    {
        return static::first(['product_id' => $productId]) ?? null;
    }
}