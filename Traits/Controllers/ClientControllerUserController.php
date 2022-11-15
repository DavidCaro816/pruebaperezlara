<?php

namespace Traits\Controllers;

use App\Models\Client;

trait ClientControllerUserController
{
    public function totalClients(): int
    {
        return (new Client()) -> total();
    }
}
