<?php

namespace App\Http\Services\UserStudent;

use App\Http\Repositories\UserStudentRepository;

class CreateOneUserStudentService
{
    protected $userStudentRepository;

    public function __construct(UserStudentRepository $userStudentRepository)
    {
        $this->userStudentRepository = $userStudentRepository;
    }

    public function handle($data)
    {
        return $this->userStudentRepository->createOne($data);
    }
}
