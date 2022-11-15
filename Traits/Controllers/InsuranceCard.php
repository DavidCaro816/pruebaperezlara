<?php

namespace Traits\Controllers;

use App\Models\Insurance;

trait InsuranceCard
{
    public function insuranceCard(): bool|array
    {
        return (new Insurance()) -> card();
    }
}
