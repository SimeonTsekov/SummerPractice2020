<?php


namespace Model\Repository;


class ResourceRepository{
    const GOLDID = 1;
    const FOODID = 2;
    const WOODID = 3;

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
        $prepared->execute([$UserId, self::GOLDID]);

        return $prepared->fetch();
    }

    public function GetUserFood($UserId){
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT `Amount` FROM `userresources` WHERE `UserId` = ? AND `ResourceId` = ?';

        $prepared = $pdo->prepare($sql);
        $prepared->execute([$UserId, self::FOODID]);

        return $prepared->fetch();
    }

    public function GetUserWood($UserId){
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT `Amount` FROM `userresources` WHERE `UserId` = ? AND `ResourceId` = ?';

        $prepared = $pdo->prepare($sql);
        $prepared->execute([$UserId, self::WOODID]);

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

        $prepared->execute([(int)$gold, $UserId, self::GOLDID]);
        $prepared->execute([(int)$food, $UserId, self::FOODID]);
        $prepared->execute([(int)$wood, $UserId, self::WOODID]);
    }
}