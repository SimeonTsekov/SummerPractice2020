<?php


namespace Controller;


use Model\Services\BuildingService;

class BuildingController
{
    public function GetBuildingLevels(){
        $service = new BuildingService();
        $levels = $service->GetUserBuildingLevels($_SESSION['UserId']);

        echo json_encode($levels);
        return $levels;
    }
}