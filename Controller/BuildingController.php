<?php


namespace Controller;


use Model\Services\BuildingService;

class BuildingController
{
    const MINEID = 1;
    const FARMID = 2;
    const LUMBERCAMPID = 3;

    public function GetBuildingLevels(){
        $service = new BuildingService();
        $levels = $service->GetUserBuildingLevels($_SESSION['UserId']);

        echo json_encode($levels);
        return $levels;
    }

    public function UpgradeMine(){
        $service = new BuildingService();
        $result = $service->UpgradeBuilding($_SESSION['UserId'], self::MINEID);

        echo json_encode($result);
    }

    public function UpgradeFarm(){
        $service = new BuildingService();
        $result = $service->UpgradeBuilding($_SESSION['UserId'], self::FARMID);

        echo json_encode($result);
    }

    public function UpgradeLumberCamp(){
        $service = new BuildingService();
        $result = $service->UpgradeBuilding($_SESSION['UserId'], self::LUMBERCAMPID);

        echo json_encode($result);
    }
}