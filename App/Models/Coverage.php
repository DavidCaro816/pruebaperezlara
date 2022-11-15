<?php

namespace App\Models;

use PDO;

class Coverage extends Model
{
    private int $id;
    private string $coverage;

    public function __construct2(int $id, string $coverage): void
    {
        $this -> __constructId($id);
        $this -> __constructCoverage($coverage);
    }

    public function __constructId(int $id): void
    {
        $this -> id = $id;
    }

    public function __constructCoverage(string $coverage): void
    {
        $this -> coverage = $coverage;
    }

    public function index(): bool|array
    {
        return $this -> connection -> query('select * from cobertura') -> fetchAll();
    }

    public function create(): void
    {
        $coverage = $this -> connection -> prepare('insert into cobertura (cobertura) values(:coverage)');
        $coverage -> bindParam('coverage', $this -> coverage);
        $coverage -> execute();
    }

    public function show(): bool|array
    {
        $coverage = $this -> connection -> prepare('select * from cobertura where id_cobertura = :id_coverage');
        $coverage -> bindParam('id_coverage', $this -> id, PDO::PARAM_INT);
        $coverage -> execute();
        return $coverage -> fetch();
    }

    public function update(): void
    {
        $coverage = $this -> connection -> prepare(
            'update cobertura set cobertura = :coverage where id_cobertura = :id_coverage'
        );
        $coverage -> bindParam('id_coverage', $this -> id, PDO::PARAM_INT);
        $coverage -> bindParam('coverage', $this -> coverage);
        $coverage -> execute();
    }

    public function delete(): void
    {
    }
}
