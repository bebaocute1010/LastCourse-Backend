<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getUserByEmail($email)
    {
        return User::where("email", $email)->first();
    }

    public function updateProfile($id, $data)
    {
        $user = User::find($id);
        $user->update($data);
        return $user;
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function findUser(string $field_name, string $value)
    {
        return User::where($field_name, $value)->first();
    }

    public function update(array $data)
    {
        return User::find($data["id"])->update($data);
    }
}
