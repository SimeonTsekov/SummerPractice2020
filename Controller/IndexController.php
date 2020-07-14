<?php


namespace Controller;


use Core\View;
use Model\Services\UserService;


class IndexController
{
    public function error($code)
    {
        $result = [
            'success' => false,
            'errorCode' => $code,
            'msg' => 'method or class not found'
        ];

        echo json_encode($result, JSON_PRETTY_PRINT);
        return $result;
    }

    public function home()
    {
        View::render("RegisterView");
        unset($_SESSION['UserId']);

        $_SESSION['Logged'] = false;
    }

    public function LogIn(){
        View::render('LoginView');
    }

    public function LoadMainView(){
        View::render('MainView');
        $service = new UserService();
        $service->ReturnUserIds();
    }
}