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

        if($repo->CheckUserByEmail($credentials['email'])){
            $result['msg'] = 'This user already exists!';
            return $result;
        }

        if($repo->GetUserByUsername($credentials['username'])){
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

        $user = $repo->GetUserByUsername($username);

        if(password_verify($password, $user['Password'])){
            $result['success'] = true;
            $result['id'] = $user['UserId'];
            $result['msg'] = 'User successfully logged in!';
        } else {
            $result['id'] = null;
            $result['msg'] = 'Invalid credentials!';
        }

        return $result;
    }

    public function ReturnUserIds(){
        $result = [
            'success' => false
        ];

        $repo = new UserRepository();

        if($ids = $repo->GetCurrentUserIds()){
            $result['success'] = true;
            $result['msg'] = 'Ids successfully fetched';
            $result['ids'] = $ids;
        } else {
            $result['ids'] = null;
            $result['msg'] = 'There was an error!';
        }

        return $result;
    }

    public function ReturnProducedAmounts($userId){
        $result = [
            'success' => false
        ];

        $repo = new UserRepository();

        if($amounts = $repo->GetUserProductionAmounts($userId)){
            $result['success'] = true;
            $result['msg'] = 'Amounts successfully fetched';
            $result['amounts'] = $amounts;
        } else {
            $result['ids'] = null;
            $result['msg'] = 'There was an error!';
        }

        return $result;
    }
}
