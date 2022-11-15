<?php

namespace Core;

use PDO;
use PDOException;

class Connection
{
    private string $driver;
    private string $hostname;
    private string $database;
    private string $username;
    private string $password;

    public function __construct()
    {
        $credenciales = ini();
        $this -> driver = $credenciales['DB_CONNECTION'];
        $this -> hostname = $credenciales['DB_HOST'];
        $this -> database = $credenciales['DB_DATABASE'];
        $this -> username = $credenciales['DB_USERNAME'];
        $this -> password = $credenciales['DB_PASSWORD'];
    }

    public function connect(): PDO
    {
        try {
            $connection = new PDO(
                $this -> driver . ':host=' . $this -> hostname . ';dbname=' . $this -> database,
                $this -> username,
                $this -> password,
                options: [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException) {
            $connection = false;
        }
        return $connection;
    }
}
