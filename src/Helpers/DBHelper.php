<?php

namespace App\Helpers;


class DBHelper
{
    private $dbh = null;

    private array $config = [];

    private static $instance = null;

    public static function getInstance(): static
    {
        if (!static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function createTable(string $tableName, array $fields): int|bool
    {
        $str = '';
        foreach ($fields as $key => $field) {
            $str .= $key . ' ' . $field . ', ';
        }
        $str = substr($str, 0, -2);

        $sql = "CREATE TABLE IF NOT EXISTS $tableName (" .
            $str .
            ") ENGINE=InnoDB";
        $sth = $this->dbh->prepare($sql);

        return $sth->execute();
    }

    public function dropTableIfExists(string $tableName): int|bool
    {
        $sql = "DROP TABLE IF EXISTS $tableName";
        $sth = $this->dbh->prepare($sql);
        return $sth->execute();
    }

    public function insert($tableName, array $data): int|bool
    {
        $fields = array_keys($data);
        $sql = "INSERT INTO $tableName (" . implode(', ', $fields) . ") 
        VALUES ('" . implode("','", $data) . "')";

        $sth = $this->dbh->prepare($sql);
        $sth->execute();

        return $this->dbh->lastInsertId();
    }

    public function update($tableName, array $fieldsData, array $whereData): int|bool
    {
        $fields = [];
        foreach ($fieldsData as $key => $field) {
            $fields[] = $key . '=' . "'" . $field . "'";
        }
        $where = [];
        foreach ($whereData as $key => $field) {
            $where[] = $key . '=' . "'" . $field . "'";
        }

        $sql = "UPDATE $tableName SET " . implode(', ', $fields) . " WHERE " . implode(' AND ', $where) . ";";

        $sth = $this->dbh->prepare($sql);

        return $sth->execute();
    }

    public function select($tableName, array $where = [], $model = ''): array
    {
        $fields = [];
        foreach ($where as $key => $value) {
            $fields[] = $key . " = '" . $value . "'";
        }
        if (empty($fields)) {
            $sql = "SELECT * FROM $tableName;";
        } else {
            $sql = "SELECT * FROM $tableName WHERE " . implode(' AND ', $fields) . ";";
        }

        $sth = $this->dbh->prepare($sql);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_CLASS, $model);
    }

    private function __construct()
    {
        $this->config = (new ConfigHelper())->get('db');
        extract($this->config);

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            $this->dbh = new \PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}