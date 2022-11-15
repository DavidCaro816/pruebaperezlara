<?php

namespace Traits\Models;

use PDO;

trait ClientUser
{
    private string|int $document;
    private string $first_name;
    private string $first_surname;
    private string $phone;
    private string $email;
    private string|null $second_name;
    private string|null $second_surname;
    private int $document_type;

    public function beginParams($sql): void
    {
        $sql -> bindParam('document', $this -> document);
        $sql -> bindParam('first_name', $this -> first_name);
        $sql -> bindParam('second_name', $this -> second_name);
        $sql -> bindParam('first_surname', $this -> first_surname);
        $sql -> bindParam('second_surname', $this -> second_surname);
    }

    public function documentType(): bool|array
    {
        return $this -> connection -> query(
            'select id_tipo_documento, descripcion_documento from tipo_documento'
        ) -> fetchAll(PDO::FETCH_NUM);
    }

    /**
     * @return string
     */
    public function getDocument(): string
    {
        return $this -> document;
    }
}
