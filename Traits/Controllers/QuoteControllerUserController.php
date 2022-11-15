<?php

namespace Traits\Controllers;

use App\Models\Quote;

trait QuoteControllerUserController
{
    public function totalQuotes(): int
    {
        return (new Quote()) -> total();
    }
}
