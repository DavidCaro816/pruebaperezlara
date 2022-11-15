<?php

namespace App\Models;

use Exception;
use PDO;
use PDOException;
use PDOStatement;
use Storage\FileService;
use Traits\Models\VerifyFileService;

class Policy extends Model
{
    use VerifyFileService;

    private int $code;
    private Insurance $insurance;
    private Insurer $insurer;
    private Quote $quote;
    private ?FileService $file_service;
    private float $insured_value;
    private float $premium_value;
    private string $start_date;
    private string $expiration_date;
    private string $payment_date;
    private int $months;

    public function __construct11(
        int $code,
        Insurance $insurance,
        Insurer $insurer,
        float $insured_value,
        float $premium_value,
        ?FileService $file,
        string $start_date,
        string $expiration_date,
        string $payment_date,
        int $months,
        Quote $quote,
    ): void {
        $this -> __construct1($code);
        $this -> insurer = $insurer;
        $this -> insurance = $insurance;
        $this -> insured_value = $insured_value;
        $this -> premium_value = $premium_value;
        $this -> file_service = $file;
        $this -> start_date = $start_date;
        $this -> expiration_date = $expiration_date;
        $this -> payment_date = $payment_date;
        $this -> months = $months;
        $this -> quote = $quote;
    }

    public function __construct1(int $code): void
    {
        $this -> code = $code;
    }

    public function index(): bool|array
    {
        return $this -> connection -> query(
            'select `Codigo póliza`, Fecha, Cliente, Seguro, Aseguradora, `Fecha de inicio`, 
       `Fecha de vencimiento`, `Valor asegurado`, `Valor prima`, `Fecha de pago`, Estado, `Fecha de actualización` from view_poliza'
        ) -> fetchAll();
    }

    public function total(): int
    {
        return $this -> connection -> query('select count(*) from view_poliza') -> fetchColumn();
    }

    public function countStates(): bool|array
    {
        return $this -> connection -> query('select count(estado) as Total from view_poliza group by estado') ->
        fetchAll();
    }

    public function params(bool|PDOStatement $sql): void
    {
        $insurance = $this -> insurance -> getId();
        $insurer = $this -> insurer -> getId();
        $quote = $this -> quote -> getId();
        $sql -> bindParam('code', $this -> code, PDO::PARAM_INT);
        $sql -> bindParam('insurance', $insurance, PDO::PARAM_INT);
        $sql -> bindParam('insurer', $insurer, PDO::PARAM_INT);
        $sql -> bindParam('insured_value', $this -> insured_value);
        $sql -> bindParam('premium_value', $this -> premium_value);
        $sql -> bindParam('start_date', $this -> start_date);
        $sql -> bindParam('expiration_date', $this -> expiration_date);
        $sql -> bindParam('payment_date', $this -> payment_date);
        $sql -> bindParam('months', $this -> months, PDO::PARAM_INT);
        $sql -> bindParam('quote', $quote, PDO::PARAM_INT);
    }

    public function create() :bool|string
    {
        try {
            $policy = $this -> connection -> prepare(
                'call sp_insert_poliza(:code, :insurance, :insurer, :insured_value, :premium_value, :start_date, 
                :expiration_date, :payment_date, :months, :quote)'
            );
            $this -> params($policy);
            $policy -> execute();
            return true;
        } catch (PDOException $e) {
            return $e -> getMessage();
        }
    }

    public function show(): bool|array
    {
        $policy = $this -> connection -> prepare("select * from view_poliza where `Codigo póliza` = :code");
        $policy -> bindParam('code', $this -> code, PDO::PARAM_INT);
        $policy -> execute();
        return $policy -> fetch();
    }

    public function update(int $code) :bool|string
    {
        try {
            $policy = $this -> connection -> prepare(
                'call sp_update_poliza(:code2,:code, :insurance, :insurer, :insured_value, :premium_value, :start_date, :expiration_date, :payment_date, :months, :quote)'
            );
            $policy -> bindParam('code2', $code);
            $this -> params($policy);
            $policy -> execute();
            return true;
        } catch (Exception $e) {
            return $e -> getMessage();
        }
    }

    public function delete(): void
    {
        $policy = $this -> connection -> prepare('call sp_delete_poliza(:code)');
        $policy -> bindParam('code', $this -> code, PDO::PARAM_INT);
        $policy -> execute();
    }

    public function state(): bool|array
    {
        return $this -> connection -> query('select * from estado  where id_estado > 5 and id_estado < 9') -> fetchAll(
            PDO::FETCH_NUM
        );
    }

    public function upload(): array|string
    {
        return $this -> file_service -> upload();
    }

    public function updateFile() :array|string
    {
        return $this -> file_service -> update();
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this -> code;
    }
}
