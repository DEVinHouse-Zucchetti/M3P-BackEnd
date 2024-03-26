<?php

namespace App\Http\Services\Avaliation;

use App\Http\Repositories\AvaliationRepository;

class CreateAvaliationService
{
    private $avaliationRepository;

    public function __construct(AvaliationRepository $avaliationRepository)
    {
        $this->avaliationRepository = $avaliationRepository;
    }

    public function handle($data)
    {
        return $this->avaliationRepository->createAvaliation($data);
    }
}

?>
