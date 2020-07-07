<?php


namespace Controller;


use Core\View;
use Model\Services\UserService;

class UserController
{
    private array $credentials;

    public function SetCredentials(){
        if(isset($_POST['create'])){
            $username = $_POST['usn'];
            $email = $_POST['email'];
            $password = $_POST['psw'];
            $confirmedPassword = $_POST['cpsw'];

            $this->credentials = [$username, $email, $password, $confirmedPassword];
        }
    }

    public function ValidatePassword(){
        return $this->credentials[3] === $this->credentials[2];
    }

    public function RegisterUser(){
        $this->SetCredentials();
        $service = new UserService();
        if($this->ValidatePassword()){
            View::render("MainView");
            $service->RegisterUser($this->credentials);
            var_dump($this->credentials);
        } else {
            View::render("RegisterView");
            echo "Please confirm your password!";
        }
    }
}