<?php

namespace App\Controllers;

use App\Models\Insurer;
use Traits\Controllers\InsurerActive;
use Traits\Controllers\InsurerCard;

class InsurerController extends Controller
{
    use InsurerActive;
    use InsurerCard;

    public function index(): bool|array
    {
        return $this -> insurerActive();
    }

    public function create(Insurer $insurer): void
    {
        $insurer -> create();
        $this -> response('Aseguradora registrada');
    }

    public function show(Insurer $insurer): void
    {
        echo json_encode($insurer -> show());
    }

    public function update(Insurer $insurer): void
    {
        $insurer -> update();
        $this -> response('Aseguradora actualizada');
    }

    public function delete(Insurer $insurer): void
    {
        $insurer -> delete();
        $this -> response('Aseguradora eliminada');
    }
}
