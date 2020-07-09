<?php


namespace Model\Repository;

define("GOLDID", 1);
define("FOODID", 2);
define("WOODID", 3);

class
ResourceRepository
{
    public function InitializePlayerResources($UserId){
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'INSERT INTO `userresources` (`UserResourceId`, `UserId`, `ResourceId`, `Amount`)
                VALUES (NULL,?,1,100), (NULL,?,2,100), (NULL,?,3,100)';

        $prepared = $pdo->prepare($sql);
        return $prepared->execute([$UserId, $UserId, $UserId]);
    }

    public function GetUserGold($UserId){
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT `Amount` FROM `userresources` WHERE `UserId` = ? AND `ResourceId` = ?';

        $prepared = $pdo->prepare($sql);
        $prepared->execute([$UserId, GOLDID]);

        return $prepared->fetch();
    }

    public function GetUserFood($UserId){
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT `Amount` FROM `userresources` WHERE `UserId` = ? AND `ResourceId` = ?';

        $prepared = $pdo->prepare($sql);
        $prepared->execute([$UserId, FOODID]);

        return $prepared->fetch();
    }

    public function GetUserWood($UserId){
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT `Amount` FROM `userresources` WHERE `UserId` = ? AND `ResourceId` = ?';

        $prepared = $pdo->prepare($sql);
        $prepared->execute([$UserId, WOODID]);

        return $prepared->fetch();
    }

    public function IncrementValues($UserId, $amounts){
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'UPDATE `userresources` SET `Amount` = `Amount` + ? WHERE `UserId` = ? AND  `ResourceId` = ?';

        $prepared = $pdo->prepare($sql);

        if( isset($amounts['gold'])) {
            $gold = $amounts['gold'];
        }

        if( isset($amounts['food'])) {
            $food = $amounts['food'];
        }

        if( isset($amounts['wood'])) {
            $wood = $amounts['wood'];
        }

        $prepared->execute([(int)$gold, $UserId, GOLDID]);
        $prepared->execute([(int)$food, $UserId, FOODID]);
        $prepared->execute([(int)$wood, $UserId, WOODID]);
    }
}