<?php

namespace Traits\Controllers;

use App\Models\Coverage;

trait CoverageActive
{
    public function coverageActive(): bool|array
    {
        return (new Coverage()) -> index();
    }
}
