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

    public function GetUserMineInfo($UserId){
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT `Level`, `UpgradeCost`, `ProduceAmount` FROM `userbuildings` WHERE `UserId` = ? AND `BuildingId` = ?';

        $prepared = $pdo->prepare($sql);
        $prepared->execute([$UserId, self::MINEID]);

        return $prepared->fetch();
    }

    public function GetUserFarmInfo($UserId){
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT `Level`, `UpgradeCost`, `ProduceAmount` FROM `userbuildings` WHERE `UserId` = ? AND `BuildingId` = ?';

        $prepared = $pdo->prepare($sql);
        $prepared->execute([$UserId, self::FARMID]);

        return $prepared->fetch();
    }

    public function GetUserLumberMillInfo($UserId){
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT `Level`, `UpgradeCost`, `ProduceAmount` FROM `userbuildings` WHERE `UserId` = ? AND `BuildingId` = ?';

        $prepared = $pdo->prepare($sql);
        $prepared->execute([$UserId, self::LUMBERCAMPID]);

        return $prepared->fetch();
    }
}