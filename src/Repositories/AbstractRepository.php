<?php

namespace App\Repositories;

use App\Helpers\DBHelper;
use App\Models\AbstractModel;

abstract class AbstractRepository
{
    public static string $model;

    public static function where(array $columns): array
    {
        $db = DBHelper::getInstance();
        $model = new static::$model();
        return $db->select($model::$table, $columns, static::$model);
    }

    public static function first(array $columns): ?AbstractModel
    {
        return static::where($columns)[0] ?? null;
    }

    public static function all(): array
    {
        return static::where([]);
    }

    public static function find(int $id): ?AbstractModel
    {
        return static::first(['id' => $id]);
    }
}