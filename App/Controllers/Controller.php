<?php

namespace App\Controllers;

abstract class Controller
{
    abstract public function index();

    public function response($msg): void
    {
        echo json_encode(['data' => $this -> index(), 'msg' => $msg]);
    }
}
