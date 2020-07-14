<?php

use Model\Services\ResourceService;
use Model\Services\UserService;

spl_autoload_register(function ($class) {
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class) . ".php";
    if (file_exists($class)) {
        require_once $class;
    }
});

$ids = [];
$userService = new UserService();
$resourceService = new ResourceService();

while(true){
    $resultIds=$userService->ReturnUserIds();
    $ids = (array)$resultIds['ids'];

    if($resultIds['success']){
        for($i=0; $i<count($ids); $i++){
            $UserId = $ids[$i];
            $resultAmounts = $userService->ReturnProducedAmounts($UserId);
            $resourceService->IncrementResources($UserId, $resultAmounts['amounts']);
        }
    } else {
        echo $ids['msg'];
    }

    sleep(10);
}