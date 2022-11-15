<?php

namespace App\Controllers;

use App\Models\Coverage;
use Traits\Controllers\CoverageActive;

class CoverageController extends Controller
{
    use CoverageActive;

    public function index(): bool|array
    {
        return $this -> coverageActive();
    }

    public function create(Coverage $coverage): void
    {
        $coverage -> create();
        $this -> response('Cobertura creada');
    }

    public function show(Coverage $coverage): void
    {
        echo json_encode($coverage -> show());
    }

    public function update(Coverage $coverage): void
    {
        $coverage -> update();
        $this -> response('Cobertura actualizada');
    }

    public function delete(Coverage $coverage): void
    {
        $coverage -> delete();
        $this -> response('Cobertura eliminada');
    }
}
