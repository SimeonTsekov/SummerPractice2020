<?php


namespace Controller;


use Core\View;
use Model\Services\UserService;

class UserController
{
    private array $credentials;

    public function SetCredentials(){
        if(isset($_POST['create'])){
            $this->credentials['username'] = $_POST['usn'];
            $this->credentials['email'] = $_POST['email'];
            $this->credentials['password'] = $_POST['psw'];
            $this->credentials['confirmedPassword'] = $_POST['cpsw'];
        }
    }

    public function Register(){
        $this->SetCredentials();

        if(!$this->ValidatePasswordLength($this->credentials['password'])){
            View::render('RegisterView');
            echo 'Password must be between 8 and 16 symbols!';
            return;
        }

        if(!$this->ValidatePassword($this->credentials)){
            View::render('RegisterView');
            echo 'Please confirm your password!';
            return;
        }

        $service = new UserService();
        $result = $service->RegisterUser($this->credentials);

        if(!$result['success']){
            View::render('RegisterView');
            echo $result['msg'];
            return;
        }

        View::render("LoginView");
    }

    public function Log(){
        $username = $_POST['usn'];
        $password = $_POST['psw'];

        $service = new UserService();
        $result = $service->LogUser($username, $password);

        if(!$result['success']){
            View::render('LoginView');
            echo $result['msg'];
            return;
        }

        if(session_status() == PHP_SESSION_NONE) {
            ini_set('session.cookie_lifetime', 60 * 60 * 24 * 365);
            ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 365);
            session_start();
        }
        $_SESSION['UserId'] = $result['id'];
        $_SESSION['Logged'] = true;
        View::render("MainView");
        var_dump($_SESSION['UserId']);

    }

    public function ValidatePassword($credentials){
        return $credentials['password'] === $credentials['confirmedPassword'];
    }

    public function ValidatePasswordLength($password){
        return (strlen($password)>=8 && strlen($password)<=16);
    }
}