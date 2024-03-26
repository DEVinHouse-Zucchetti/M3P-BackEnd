<?php

namespace App\Http\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function createOne(array $data)
    {
        return User::create($data);
    }
}
