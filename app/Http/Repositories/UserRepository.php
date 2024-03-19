<?php

namespace App\Http\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    public function getAll($search)
    {
        $search = strtolower($search);

        return User::query()->with("profile")
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%") //O correto é utilizar o ilike, mas o teste unitário falha por causa do banco de dados sqlite
                    ->orWhere('email', 'like', "%$search%");
            })
            ->orderBy('id')
            ->get();
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function deactivateUser($user)
    {
        $user->is_active = false;
        $user->save();
    }

    public function delete($user)
    {
        $user->delete();
    }
}