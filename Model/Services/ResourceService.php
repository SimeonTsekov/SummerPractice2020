<?php


namespace Model\Services;


use http\Client\Curl\User;
use Model\Repository\ResourceRepository;

class ResourceService
{
    public function InitializeUserResources($UserId){
        $result = [
            'success' => false
        ];

        $repo = new ResourceRepository();

        if($repo->InitializePlayerResources($UserId)){
            $result['success'] = true;
            $result['msg'] = 'Resources successfully initialized!';
            return $result;
        }
    }

    public function GetUserResources($UserId){
        $result = [
            'success' => false
        ];

        $repo = new ResourceRepository();

        $resources['gold'] = $repo->GetUserGold($UserId);
        $resources['food'] = $repo->GetUserFood($UserId);
        $resources['wood'] = $repo->GetUserWood($UserId);

        if($resources['gold'] && $resources['food'] && $resources['gold']){
            $result['success'] = true;
            $result['msg'] = 'Resources successfully fetched from db!';
            return $resources;
        }
    }

    public function IncrementResources($UserId, $amounts){
        $result = [
            'success' => false
        ];

        $repo = new ResourceRepository();

        if($repo->IncrementValues($UserId, $amounts)){
            $result['success'] = true;
            $result['msg'] = 'Resources successfully incremented!';
            return $result;
        }
    }
}