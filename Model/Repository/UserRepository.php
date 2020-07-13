<?php


namespace Model\Repository;


class UserRepository{
    const MINEID = 1;
    const FARMID = 2;
    const LUMBERCAMPID = 3;

    public function RegisterUser(array $credentials){
        $username = $credentials['username'];
        $email = $credentials['email'];
        $password = password_hash($credentials['password'], PASSWORD_BCRYPT);

        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'INSERT INTO `users` (`Username`, `Password`, `Email`, `EmailVerified`)
                VALUES (?,?,?,?)';

        $prepared = $pdo->prepare($sql);
        return $prepared->execute([$username, $password, $email, false]);

    }

    public function CheckUserByEmail($email){
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT * FROM `users` WHERE `Email` LIKE ?';

        $prepared = $pdo->prepare($sql);
        $prepared->execute([$email]);

        return $prepared->fetch(\PDO::FETCH_ASSOC);
    }

    public function GetUserByUsername($username){
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT `UserId`, `Password` FROM `users` WHERE `Username` = ?';

        $prepared = $pdo->prepare($sql);
        $prepared->execute([$username]);

        return $prepared->fetch();
    }

    public function GetCurrentUserIds(){
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT `UserId` FROM `users`';

        $prepared = $pdo->prepare($sql);
        $prepared->execute([]);

        $result = $prepared->fetchAll();
        $ids = [];

        for($i=0; $i<count($result); $i++){
            array_push($ids, $result[$i]['UserId']);
        }

        return $ids;
    }

    public function GetUserProductionAmounts($userId){
        $pdo = DBManager::getInstance()->getConnection();
        $amounts['gold'] = 0;
        $amounts['food'] = 0;
        $amounts['wood'] = 0;

        $sql = 'SELECT `ProduceAmount` FROM `userbuildings` WHERE `UserId` = ? AND `BuildingId` = ?';

        $prepared = $pdo->prepare($sql);
        $prepared->execute([$userId, self::MINEID]);

        if($value = $prepared->fetch()){
            $amounts['gold'] = (int)$value['ProduceAmount'];
        }

        $prepared->execute([$userId, self::FARMID]);

        if($value = $prepared->fetch()) {
            $amounts['food'] = (int)$value['ProduceAmount'];
        }

        $prepared->execute([$userId, self::LUMBERCAMPID]);

        if($value = $prepared->fetch()) {
            $amounts['wood'] = (int)$value['ProduceAmount'];
        }
        return $amounts;
    }
}