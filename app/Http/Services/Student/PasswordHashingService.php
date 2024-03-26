<?php

namespace App\Http\Services\Student;

use Illuminate\Support\Facades\Hash;

class PasswordHashingService
{
    public function handle($password)
    {
        return Hash::make($password);
    }
}
