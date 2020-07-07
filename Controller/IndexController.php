<?php


namespace Controller;


use Core\View;

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
    }
}