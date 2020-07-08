<?php


namespace Model\Repository;


class UserRepository
{
    public function RegisterUser(array $credentials){
        $username = $credentials[0];
        $email = $credentials[1];
        $password = password_hash($credentials[2], PASSWORD_BCRYPT);

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

    public function CheckUserByUsername($username){
        $pdo = DBManager::getInstance()->getConnection();

        $sql = 'SELECT * FROM `users` WHERE `Username` LIKE ?';

        $prepared = $pdo->prepare($sql);
        $prepared->execute([$username]);

        return $prepared->fetch(\PDO::FETCH_ASSOC);
    }
}