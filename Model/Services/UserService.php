<?php


namespace Model\Services;


use Model\Repository\UserRepository;

class UserService
{
    public function RegisterUser(array $credentials){
        $repo = new UserRepository();

        return $repo->RegisterUser($credentials);
    }
}