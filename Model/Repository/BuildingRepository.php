<?php


namespace Model\Repository;


class BuildingRepository
{
    const MINEID = 1;
    const FARMID = 2;
    const LUMBERCAMPID = 3;

    public function InitializePlayerBuildings($UserId){
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'INSERT INTO `userbuildings` (`UserBuildingId`, `UserId`, `BuildingId`, `Level`, `UpgradeCost`, `ProduceAmount`)
                VALUES (NULL,?,1,1,200,5), (NULL,?,2,1,200,5), (NULL,?,3,1,200,5)';

        $prepared = $pdo->prepare($sql);
        return $prepared->execute([$UserId, $UserId, $UserId]);
    }

    public function GetUserBuildingInfo($UserId, $BuildingId){
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT `Level`, `UpgradeCost`, `ProduceAmount` FROM `userbuildings` WHERE `UserId` = ? AND `BuildingId` = ?';

        $prepared = $pdo->prepare($sql);
        $prepared->execute([$UserId, $BuildingId]);

        return $prepared->fetch();
    }

    public function UpgradeBuilding($UserId, $BuildingId){
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'UPDATE `userbuildings` SET `Level` = `Level` + 1, `UpgradeCost` = `UpgradeCost` * 2, `ProduceAmount` = `ProduceAmount` * 2 
WHERE `UserId` = ? AND `BuildingId` = ?';

        $prepared = $pdo->prepare($sql);
        $prepared->execute([$UserId, $BuildingId]);
    }
}