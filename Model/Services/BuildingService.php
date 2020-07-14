<?php


namespace Model\Services;


use Model\Repository\BuildingRepository;
use Model\Repository\ResourceRepository;
use Model\Repository\UserRepository;

class BuildingService
{
    const MINEID = 1;
    const FARMID = 2;
    const LUMBERCAMPID = 3;

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

        $mineInfo = $repo->GetUserBuildingInfo($UserId, self::MINEID);
        $farmInfo = $repo->GetUserBuildingInfo($UserId, self::FARMID);
        $lumberInfo = $repo->GetUserBuildingInfo($UserId, self::LUMBERCAMPID);

        $levels['gold'] = $mineInfo['Level'];
        $levels['farm'] = $farmInfo['Level'];
        $levels['lumber'] = $lumberInfo['Level'];

        if($levels['gold'] && $levels['farm'] && $levels['lumber']){
            $result['success'] = true;
            $result['msg'] = 'Building levels successfully fetched from db!';
            return $levels;
        }
    }

    public function UpgradeBuilding($UserId, $BuildingId){
        $result = [
            'success' => false
        ];

        $repo = new BuildingRepository();
        $resourceRepo = new ResourceRepository();

        $buildingInfo = $repo->GetUserBuildingInfo($UserId,$BuildingId);

        (int)$upgradeCost = $buildingInfo['UpgradeCost'];
        $userGold = $resourceRepo->GetUserGold($UserId);

        if($userGold['Amount']>=$upgradeCost){
            $result['success'] = true;
            $resourceRepo->DecrementGold($UserId, $upgradeCost);
            $repo->UpgradeBuilding($UserId, $BuildingId);
        }

        $result['remaining'] = $resourceRepo->GetUserGold($UserId);
        return $result;
    }
}