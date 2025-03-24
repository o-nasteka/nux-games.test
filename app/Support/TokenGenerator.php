<?php

namespace App\Support;

use Illuminate\Support\Str;

class TokenGenerator
{
    /**
     * Generate a unique access token.
     */
    public static function generate(): string
    {
        return Str::uuid();
    }
}
