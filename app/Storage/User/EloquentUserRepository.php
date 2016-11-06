<?php

namespace App\Storage\User;

use App\Models\User;
use Auth;
use DB;

class EloquentUserRepository implements UserRepository
{
    public function isExist($email)
    {
        $user = User::where('email', $email)->exists();

        if(!empty($user))
        {
            return true;
        } else {
            return false;
        }
    }

    public function loginUser($email)
    {
        $user = User::where('email', $email)->first();

        Auth::loginUsingId($user->id);
    }
}
