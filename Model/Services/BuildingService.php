<?php


namespace Model\Services;


use Model\Repository\BuildingRepository;

class BuildingService
{
    public function InitializeUserBuildings($UserId){
        $result = [
            'success' => false
        ];

        $repo = new BuildingRepository();

        if($repo->InitializePlayerBuildings($UserId)){
            $result['success'] = true;
            $result['msg'] = 'Buildings successfully initialized!';
            return $result;
        }
    }

    public function GetUserBuildingLevels($UserId){
        $result = [
            'success' => false
        ];

        $repo = new BuildingRepository();

        $mineInfo = $repo->GetUserMineInfo($UserId);
        $farmInfo = $repo->GetUserFarmInfo($UserId);
        $lumberInfo = $repo->GetUserLumberMillInfo($UserId);

        $levels['gold'] = $mineInfo['Level'];
        $levels['farm'] = $farmInfo['Level'];
        $levels['lumber'] = $lumberInfo['Level'];

        if($levels['gold'] && $levels['farm'] && $levels['lumber']){
            $result['success'] = true;
            $result['msg'] = 'Building levels successfully fetched from db!';
            return $levels;
        }
    }
}