<?php

namespace Traits\Controllers;

use App\Models\Insurer;

trait InsurerCard
{
    public function insurerCard(): bool|array
    {
        return (new Insurer()) -> card();
    }
}
