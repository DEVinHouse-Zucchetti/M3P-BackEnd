<?php

namespace App\Http\Repositories;

use App\Models\Avaliation;


class AvaliationRepository {

    public function createAvaliation(array $data) {
        return Avaliation::create($data);
    }
}
