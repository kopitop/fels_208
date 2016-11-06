<?php

namespace App\Storage\User;

interface UserRepository
{
    public function isExist($email);

    public function loginUser($email);
}
