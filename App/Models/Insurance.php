<?php

namespace App\Models;

use PDO;
use PDOStatement;

class Insurance extends Model
{
    private int $id;
    private string $insurance;
    private string $image;

    public function __construct3(int $id, string $insurance, string $image): void
    {
        $this -> __construct1($id);
        $this -> __construct2($insurance, $image);
    }

    public function __construct1(int $id): void
    {
        $this -> id = $id;
    }

    public function __construct2(string $insurance, string $image): void
    {
        $this -> insurance = $insurance;
        $this -> image = $image;
    }

    public function index(): bool|array
    {
        return $this -> connection -> query(
            'select s.id_seguro, s.seguro from seguro_aseguradora 
    inner join seguro s on seguro_aseguradora.seguro = s.id_seguro where estado = 1 group by s.id_seguro'
        ) -> fetchAll();
    }

    public function create(): void
    {
        $insurance = $this -> connection -> prepare('call sp_insert_seguro(:insurance,:image)');
        $this -> params($insurance);
        $insurance -> execute();
    }

    public function params(bool|PDOStatement $sql): void
    {
        $sql -> bindParam('insurance', $this -> insurance);
        $sql -> bindParam('image', $this -> image);
    }

    public function show(): bool|array
    {
        $insurance = $this -> connection -> prepare(
            'select seguro, imagen from seguro where id_seguro = :id_insurance'
        );
        $insurance -> bindParam('id_insurance', $this -> id, PDO::PARAM_INT);
        $insurance -> execute();
        return $insurance -> fetch();
    }

    public function card(): bool|array
    {
        return $this -> connection -> query('select * from seguro') -> fetchAll();
    }

    public function update(): void
    {
        $insurance = $this -> connection -> prepare('call sp_update_seguro(:id_insurance,:insurance,:image)');
        $insurance -> bindParam('id_insurance', $this -> id, PDO::PARAM_INT);
        $this -> params($insurance);
        $insurance -> execute();
    }

    public function delete(): void
    {
        $insurance = $this -> connection -> prepare('call sp_delete_seguro(:id_insurance)');
        $insurance -> bindParam('id_insurance', $this -> id, PDO::PARAM_INT);
        $insurance -> execute();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this -> id;
    }
}
