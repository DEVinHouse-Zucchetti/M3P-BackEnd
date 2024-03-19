<?php

namespace App\Http\Services\User;

use App\Http\Repositories\UserRepository;
use App\Traits\HttpResponses;

use Illuminate\Http\Response;

class DeleteOneUserService
{
    use HttpResponses;

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle($id)
    {

        $user = $this->userRepository->find($id);

        if (!$user) {
            return $this->error('O usuário não está cadastrado no banco de dados.', Response::HTTP_NOT_FOUND);
        }

        $this->userRepository->deactivateUser($user);
        $this->userRepository->delete($user);

        return $this->response('', Response::HTTP_NO_CONTENT);
    }
}