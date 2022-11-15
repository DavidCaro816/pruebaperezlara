<?php

namespace App\Controllers;

use App\Models\Insurance;
use Traits\Controllers\InsuranceActive;
use Traits\Controllers\InsuranceCard;

class InsuranceController extends Controller
{
    use InsuranceActive;
    use InsuranceCard;

    public function index(): bool|array
    {
        return $this -> insuranceActive();
    }

    public function create(Insurance $insurance): void
    {
        $insurance -> create();
        $this -> response('Seguro registrado');
    }

    public function show(Insurance $insurance): void
    {
        echo json_encode($insurance -> show());
    }

    public function update(Insurance $insurance): void
    {
        $insurance -> update();
        $this -> response('Seguro actualizado');
    }

    public function delete(Insurance $insurance): void
    {
        $insurance -> delete();
        $this -> response('Seguro eliminado');
    }
}
