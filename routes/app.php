<?php

use App\Controllers\ClientController;
use App\Controllers\PolicyController;
use App\Controllers\QuoteController;
use App\Controllers\SinisterController;
use App\Controllers\UserController;

return [
    'login' => UserController::class,
    'clientes' => ClientController::class,
    'cotizaciones' => QuoteController::class,
    'polizas' => PolicyController::class,
    'siniestros' => SinisterController::class,
    'perfil' => UserController::class
];
