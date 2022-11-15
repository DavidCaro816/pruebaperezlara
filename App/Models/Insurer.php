<?php

namespace App\Models;

use PDO;
use PDOStatement;

class Insurer extends Model
{
    private int $id;
    private string $insurer;
    private string $logo;

    public function __construct3(int $id, string $insurer, string $logo): void
    {
        $this -> __construct1($id);
        $this -> __construct2($insurer, $logo);
    }

    public function __construct1(int $id): void
    {
        $this -> id = $id;
    }

    public function __construct2(string $insurer, string $logo): void
    {
        $this -> insurer = $insurer;
        $this -> logo = $logo;
    }

    public function index(): bool|array
    {
        return $this -> connection -> query(
            'select a.id_aseguradora, a.aseguradora from aseguradora a
        inner join seguro_aseguradora sa on sa.aseguradora = a.id_aseguradora where estado = 1 group by a.id_aseguradora'
        ) -> fetchAll();
    }

    public function card(): bool|array
    {
        return $this -> connection -> query(
            'select group_concat(s.seguro) as seguros ,a.logo as aseguradora 
                                                      from aseguradora a 
                                                      inner join seguro_aseguradora sa on sa.aseguradora = a.id_aseguradora 
                                                      inner join seguro s on sa.seguro = s.id_seguro group by a.aseguradora'
        ) -> fetchAll();
    }

    public function create(): void
    {
        $insurer = $this -> connection -> prepare('call sp_insert_aseguradora(:insurer,:logo)');
        $this -> params($insurer);
        $insurer -> execute();
    }

    public function params(bool|PDOStatement $sql): void
    {
        $sql -> bindParam('insurer', $this -> insurer);
        $sql -> bindParam('logo', $this -> logo);
    }

    public function show(): bool|array
    {
        $insurance = $this -> connection -> prepare('select * from aseguradora where id_aseguradora = :id_insurer');
        $insurance -> bindParam('id_insurer', $this -> id, PDO::PARAM_INT);
        return $insurance -> fetch();
    }

    public function update(): void
    {
        $insurer = $this -> connection -> prepare('call sp_update_aseguradora(:id_insurer,:insurer,:logo)');
        $insurer -> bindParam('id_insurer', $this -> id, PDO::PARAM_INT);
        $this -> params($insurer);
        $insurer -> execute();
    }

    public function delete(): void
    {
        $insurer = $this -> connection -> prepare('call sp_delete_aseguradora(:id_insurer)');
        $insurer -> bindParam('id_insurer', $this -> id, PDO::PARAM_INT);
        $insurer -> execute();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this -> id;
    }
}
