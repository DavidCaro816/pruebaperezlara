<?php

namespace Traits\Controllers;

use App\Models\Insurer;

trait InsurerActive
{
    public function insurerActive(): bool|array
    {
        return (new Insurer()) -> index();
    }
}
