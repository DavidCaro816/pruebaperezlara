<?php

namespace App\Models;

use Core\Connection;
use PDO;
use Traits\Models\TConstruct;

class Model
{
    use TConstruct;
    protected PDO $connection;

    public function __construct(...$args)
    {
        $this -> connection = (new Connection()) -> connect();
        call_user_func_array([$this,'construct'], $args);
    }

    public function sqlFilter(string $columns, string $table, array ...$data): bool|array
    {
        $sql = 'select ' . $columns . ' from ' . $table . ' where ';
        $array_conditions = $data[count($data) - 1];
        foreach ($array_conditions as $index => $condition) {
            $sql .= ucfirst($condition) . ' in(:' . $condition.')';
            if ($index !== count($array_conditions) - 1) {
                $sql .= 'and ';
            }
        }
        $filter = $this -> connection -> prepare($sql);
        foreach ($array_conditions as $index => $condition) {
            $$condition = implode(',', $data[$index]);
            $filter -> bindParam($condition, $$condition);
        }
        $filter -> execute();
        return $filter -> fetchAll();
    }
}
