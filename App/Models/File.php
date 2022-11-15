<?php

namespace App\Models;

use PDOException;
use ReflectionClass;
use ReflectionException;

class File extends Model
{
    private int $id;
    private string $file;
    private string $filename;
    private Policy|Sinister|Annex $owner;

    public function __construct1(int $id): void
    {
        $this -> id = $id;
    }

    public function __constructOwner(string $file, string $filename, Policy|Sinister|Annex $owner): void
    {
        $this -> file = $file;
        $this -> filename = $filename;
        $this -> owner = $owner;
    }

    public function __constructUpdate(int $id, string $file, string $filename): void
    {
        $this -> id = $id;
        $this -> file = $file;
        $this -> filename = $filename;
    }

    public function create() :bool|string
    {
        try {
            $classes = strtolower(((new ReflectionClass($this)) -> getProperty('owner')) -> getType());
            $owner = 'id_'.strtolower((new ReflectionClass($this -> owner)) -> getShortName());
            $file = $this -> connection -> prepare('call sp_insert_archivo(:file,:filename,:id_annex,:id_sinister,:id_policy)');
            $file -> bindParam('file',$this -> file);
            $file -> bindParam('filename',$this -> filename);
            foreach (explode('|',$classes) as $value) {
                $class = 'id_'.substr($value,strripos($value,'\\') + 1, strlen($value));
                if ($class === $owner) {
                    $$class = $owner === 'id_policy' ? $this -> owner -> getCode() : $this -> owner -> getId();
                } else {
                    $$class = null;
                }
                $file -> bindParam($class,$$class);
            }
            $file -> execute();
            return true;
        } catch (ReflectionException|PDOException $e) {
            return $e -> getMessage();
        }
    }

    public function update() :bool|string
    {
        try {
            $file = $this -> connection -> prepare('call sp_update_archivo(:id_file, :file, :filename)');
            $file -> bindParam('id_file',$this -> id);
            $file -> bindParam('file',$this -> file);
            $file -> bindParam('filename',$this -> filename);
            $file -> execute();
            return true;
        } catch (PDOException $e) {
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