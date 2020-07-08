<?php


namespace Model\Services;


use Model\Repository\UserRepository;
use mysql_xdevapi\Result;

class UserService
{
    public function RegisterUser(array $credentials){
        $result = [
            'success' => false
        ];

        $repo = new UserRepository();

        if($repo->CheckUserByEmail($credentials[1])){
            $result['msg'] = 'This user already exists!';
            return $result;
        }

        if($repo->CheckUserByUsername($credentials[0])){
            $result['msg'] = 'Username already taken!';
            return $result;
        }

        if($repo->RegisterUser($credentials)){
            $result['success'] = true;
            $result['msg'] = 'User successfully saved!';
            return $result;
        }
    }

    public function LogUser($username, $password){
        $result = [
            'success' => false
        ];

        $repo = new UserRepository();

        $row = $repo->GetUserByUsername($username);

        if(password_verify($password, $row['Password'])){
            $result['success'] = true;
            $result['id'] = $row['UserId'];
            $result['msg'] = 'User successfully logged in!';
        } else {
            $result['id'] = null;
            $result['msg'] = 'Invalid credentials!';
        }

        return $result;
    }
}
