<?php

namespace App\Models;

use Exception;
use PDO;
use PDOException;
use PDOStatement;
use Traits\Models\VerifyFileService;

class Sinister extends Model
{
    use VerifyFileService;

    private int $id;
    private string $date;
    private string $title;
    private float|null $amount;
    private string $description;
    private Policy $policy_code;
    private int $state;
    private ?array $file_service;

    public function __construct7(
        int $id,
        string $title,
        string $date,
        string $description,
        float|null $amount,
        Policy $policy_code,
        ?array $files,
    ): void {
        $this -> __construct1($id);
        $this -> __construct6($title, $date, $description, $amount, $policy_code, $files);
    }

    public function __construct1(int $id): void
    {
        $this -> id = $id;
    }

    public function __construct2(int $id, int $state): void
    {
        $this -> __construct1($id);
        $this -> state = $state;
    }

    public function __construct6(
        string $title,
        string $date,
        string $description,
        float|null $amount,
        Policy $policy_code,
        array $files,
    ): void {
        $this -> title = $title;
        $this -> date = $date;
        $this -> description = $description;
        $this -> amount = $amount;
        $this -> policy_code = $policy_code;
        $this -> file_service = $files;
    }

    public function index(): bool|array
    {
        return $this -> connection -> query(
            'select `No. Referencia`,Fecha,`Codigo póliza`,Cliente,Titulo,Seguro,
       Aseguradora,Monto,Estado,`Fecha de actualización` from view_siniestro'
        ) -> fetchAll();
    }

    public function create(): string|int
    {
        try {
            $sinister = $this -> connection -> prepare(
                'call sp_insert_siniestro(:date, :title, :description, :amount, :policy_code)'
            );
            $this -> params($sinister);
            $sinister -> execute();
            return $sinister -> fetchColumn();
        } catch (PDOException $e) {
            return $e -> getMessage();
        }
    }

    public function params(bool|PDOStatement $sql): void
    {
        $code = $this -> policy_code -> getCode();
        $sql -> bindParam('date', $this -> date);
        $sql -> bindParam('title', $this -> title);
        $sql -> bindParam('description', $this -> description);
        $sql -> bindParam('amount', $this -> amount);
        $sql -> bindParam('policy_code', $code, PDO::PARAM_INT);
    }

    public function show(): bool|array
    {
        $sinister = $this -> connection -> prepare(
            'select * from view_siniestro where `No. Referencia` = :id_sinister'
        );
        $sinister -> bindParam('id_sinister', $this -> id, PDO::PARAM_INT);
        $sinister -> execute();
        return $sinister -> fetch();
    }

    public function update() :bool|string
    {
        try {
            $sinister = $this -> connection -> prepare(
                'call sp_update_siniestro(:id_sinister,:date, :title, :description, :amount, :policy_code)'
            );
            $sinister -> bindParam('id_sinister', $this -> id, PDO::PARAM_INT);
            $this -> params($sinister);
            $sinister -> execute();
            return true;
        } catch (PDOException $e) {
            return $e -> getMessage();
        }
    }

    public function delete(): void
    {
        $sinister = $this -> connection -> prepare('call sp_delete_siniestro(:id_sinister)');
        $sinister -> bindParam('id_sinister', $this -> id, PDO::PARAM_INT);
        $sinister -> execute();
    }

    public function estado(): bool|array
    {
        return $this -> connection -> query("select * from estado where id_estado > 8") -> fetchAll(PDO::FETCH_NUM);
    }

    public function upload() :array|string
    {
        return $this -> actionFiles('upload');
    }

    public function updateFiles(): array|string
    {
        return $this -> actionFiles('update');
    }

    public function actionFiles(string $method) :array|string
    {
        try {
            $files = [];
            foreach ($this -> file_service as $file) {
                $upload_file = $file -> $method();
                if(is_string($upload_file)){
                    throw new Exception($upload_file);
                }
                $files[] = ['id' => $upload_file['id'], 'name' => $upload_file['name']];
            }
            return $files;
        } catch (Exception $e) {
            return $e -> getMessage();
        }
    }

    /**
     * @return int
     */
    public function getId() :int
    {
        return $this -> id;
    }
}
