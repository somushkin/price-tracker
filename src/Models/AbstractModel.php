<?php

namespace App\Models;

use App\Helpers\DBHelper;

abstract class AbstractModel
{
    public static string $table = '';

    protected ?int $id = null;

    protected array $modifiedFields = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function save(): AbstractModel
    {
        $db = DBHelper::getInstance();

        if (!empty($this->modifiedFields)) {
            $this->id = $db->insert(static::$table, $this->modifiedFields);

            $this->modifiedFields = [];
        }

        return $this;
    }

    public function update(): AbstractModel
    {
        $db = DBHelper::getInstance();

        $db->update(static::$table, $this->modifiedFields, ['id' => $this->id]);

        $this->modifiedFields = [];

        return $this;
    }
}