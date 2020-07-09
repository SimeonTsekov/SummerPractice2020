<?php

spl_autoload_register(function ($class) {
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class) . ".php";
    if (file_exists($class)) {
        require_once $class;
    }
});


$fileNotFoundFlag = false;
$controllerName = isset($_GET["target"]) ? $_GET["target"] : "index";

session_start();
if(session_status()==PHP_SESSION_ACTIVE && $_SESSION['Logged']){
    $methodName = isset($_GET["action"]) ? $_GET["action"] : "LoadMainView";
} else {
    $methodName = isset($_GET["action"]) ? $_GET["action"] : "home";
}

$controllerClassName = "\\Controller\\" . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClassName)) {
    $controller = new $controllerClassName();
    if (method_exists($controller, $methodName)) {
        $controller->$methodName();
    } else {
        $controller = new Controller\IndexController();
        $controller->error(404);
    }
} else {
    $fileNotFoundFlag = true;
}

if ($fileNotFoundFlag) {
    $controller->error(404);
}
