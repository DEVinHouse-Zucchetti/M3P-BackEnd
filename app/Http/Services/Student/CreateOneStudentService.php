<?php

namespace App\Http\Services\Student;

use App\Http\Repositories\StudentRepository;


class CreateOneStudentService
{
    private $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function handle($data)
    {
        return $this->studentRepository->createOne($data);
    }
}
