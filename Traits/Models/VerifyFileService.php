<?php

namespace Traits\Models;

trait VerifyFileService
{
    public function verifyFileService(): bool
    {
        return !($this -> file_service === null);
    }
}