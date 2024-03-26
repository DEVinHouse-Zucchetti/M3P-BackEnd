<?php

namespace App\Http\Repositories;

use App\Interfaces\AuthRepositoryInterface;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface
{
    private $permissions = [
        'ADMIN' => [
            'create-users',
            'get-users',
            'delete-users',
            'update-users',
            'admin-dashboard',
        ],
        'RECEPCIONISTA' => [
            'create-students',
            'get-students',
            'delete-students',
            'update-students',
            'create-documents-students',
            'get-documents-students',
            'get-avaliations'
        ],
        'INSTRUTOR' => [
            'instrutor-dashboard',
            'create-exercises',
            'get-exercises',
            'delete-exercises',
            'get-students',
            'create-workouts',
            'get-workouts',
            'delete-workouts',
            'update-workouts'
        ],
        'NUTRICIONISTA' => [
            'create-avaliations',
            'get-actives-students',
            'get-avaliations',
            'create-meal-plans',
            'get-meal-plans'
        ],
        'ALUNO' => [
            'get-workout',
            'get-meal-plans'
        ]
    ];

    public function attempt($data)
    {
        return Auth::attempt($data);
    }

    public function findProfileById($profileId)
    {
        return Profile::find($profileId);
    }

    public function getPermissions($profileName)
    {
        return $this->permissions[$profileName] ?? [];
    }
}
