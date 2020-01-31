<?php

namespace App\Http\Repository;
use App\User;
use Illuminate\Database\Capsule\Manager as Capsule;

class UserRepository
{
    public function login($username, $password) {
        $password = sha1($password);
        return User::where('username', $username)->where('password',$password)->first();
    }

}