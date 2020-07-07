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
        $result = $prepared->execute([$username, $password, $email, false]);

        return $result;
    }
}