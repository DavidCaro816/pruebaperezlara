<?php

namespace Traits\Controllers;

use App\Models\Insurance;

trait InsuranceActive
{
    public function insuranceActive(): bool|array
    {
        return (new Insurance()) -> index();
    }
}
