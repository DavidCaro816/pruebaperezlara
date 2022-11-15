<?php

namespace App\Models;

use PDO;
use PDOStatement;

class Quote extends Model
{
    private int $id;
    private int $state;
    private Client $client_document;
    private Insurance $insurance;
    private string $comparative_table;
    private User $user;

    public function __construct5(
        int $id,
        Client $client_document,
        Insurance $insurance,
        string $comparative_table,
        int $state
    ): void {
        $this -> __constructIdQuote($id);
        $this -> __constructClientDocument($client_document);
        $this -> insurance = $insurance;
        $this -> comparative_table = $comparative_table;
        $this -> state  = $state;
    }

    public function __constructIdQuote(int $id): void
    {
        $this -> id = $id;
    }

    public function __constructClientDocument(Client $document_client)
    {
        $this -> client_document = $document_client;
    }

    public function __construct4(
        Client $client_document,
        Insurance $insurance,
        string $comparative_table,
        User $user
    ): void {
        $this -> client_document = $client_document;
        $this -> insurance = $insurance;
        $this -> comparative_table = $comparative_table;
        $this -> user = $user;
    }

    public function index(): bool|array
    {
        return $this -> connection -> query(
            'select `No. Cotizacion`, Fecha, Cliente, Seguro, Aseguradora, Estado,
        `Fecha de actualización` from view_cotizacion'
        ) -> fetchAll();
    }

    public function total(): int
    {
        return $this -> connection -> query('select count(*) from view_cotizacion') -> fetchColumn();
    }

    public function recent(): bool|array
    {
        return $this -> connection -> query(
            'select `No. Cotizacion`, Cliente, Seguro, Aseguradora from view_cotizacion limit 25'
        ) -> fetchAll();
    }

    public function create(): void
    {
        $quote = $this -> connection -> prepare(
            'call sp_insert_cotizacion(:client_document,:insurance,:comparative_table,:user)'
        );
        $this -> params($quote);
        $quote -> execute();
    }

    public function params(bool|PDOStatement $sql): void
    {
        $client_document = $this -> client_document -> getDocument();
        $user = $this -> user -> getDocument();
        $insurance = $this -> insurance -> getId();
        $sql -> bindParam('client_document', $client_document);
        $sql -> bindParam('insurance', $insurance, PDO::PARAM_INT);
        $sql -> bindParam('comparative_table', $this -> comparative_table);
        $sql -> bindParam('user', $user, PDO::PARAM_INT);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this -> id;
    }

    public function show(): bool|array
    {
        $quote = $this -> connection -> prepare('select * from view_cotizacion where `No. Cotizacion` = :id_quote');
        $quote -> bindParam('id_quote', $this -> id, PDO::PARAM_INT);
        $quote -> execute();
        return $quote -> fetch();
    }

    public function accordingClient(): bool|array
    {
        $quotes = $this -> connection -> prepare('select `No. Cotizacion`, Cliente, Seguro, Aseguradora
        from view_cotizacion where Documento = :client_document');
        $client_document = $this -> client_document -> getDocument();
        $quotes -> bindParam('client_document', $client_document);
        $quotes -> execute();
        return $quotes -> fetchAll();
    }

    public function filter(array ...$array): bool|array
    {
        return $this -> sqlFilter(
            '`No. Cotizacion`,Fecha,Cliente,Seguro,Aseguradora,Estado',
            'view_cotizacion',
            ...$array
        );
    }

    public function update(): void
    {
        $quote = $this -> connection -> prepare(
            'call sp_update_cotizacion(:id_quote, :client_document,
                                                            :insurance, :comparative_table, :state)'
        );
        $quote -> bindParam('id_quote', $this -> id, PDO::PARAM_INT);
        $this -> params($quote);
        $quote -> bindParam('state', $this -> state);
        $quote -> execute();
    }

    public function delete(): void
    {
        $quote = $this -> connection -> prepare('call sp_delete_cotizacion(:id_quote)');
        $quote -> bindParam('id_quote', $this -> id, PDO::PARAM_INT);
        $quote -> execute();
    }

    public function estado(): bool|array
    {
        return $this -> connection -> query("select * from estado where id_estado > 3 and id_estado < 9") -> fetchAll(
            PDO::FETCH_NUM
        );
    }
}
