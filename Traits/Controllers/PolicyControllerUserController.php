<?php

namespace Traits\Controllers;

use App\Models\Policy;

trait PolicyControllerUserController
{
    public function totalPolicies(): int
    {
        return (new Policy()) -> total();
    }

    public function countStates(): bool|array
    {
        return (new Policy()) -> countStates();
    }
}
