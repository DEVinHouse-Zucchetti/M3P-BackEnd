<?php

namespace App\Http\Services\Student;

use Illuminate\Support\Str;

class PasswordGenerationService
{
    public function handle($length = 8)
    {
        return Str::password($length);
    }
}
