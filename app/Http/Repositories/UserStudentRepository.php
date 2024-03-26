<?php

namespace App\Http\Repositories;


use App\Interfaces\UserStudentRepositoryInterface;
use App\Models\UserStudent;

class UserStudentRepository implements UserStudentRepositoryInterface
{
    public function createOne(array $data)
    {
        return UserStudent::create($data);
    }
}
