<?php

namespace Traits\Controllers;

trait InsurerInsuranceActive
{
    use InsuranceActive;
    use InsurerActive;

    public function productsActive(): array
    {
        return ['insurers' => $this -> insurerActive(), 'insurances' => $this -> insuranceActive()];
    }
}
