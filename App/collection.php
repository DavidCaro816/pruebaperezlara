<?php

use App\Controllers\SinisterController;
use App\Models\File;
use App\Models\Sinister;
use Storage\FileService;

return [
    Sinister::class => [
        ['__construct6','__construct7','setFileService'],
        FileService::class
    ],
    SinisterController::class => [
        ['update'],
        File::class
    ],
];