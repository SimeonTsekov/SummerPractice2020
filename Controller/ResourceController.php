<?php


namespace Controller;


use Model\Services\ResourceService;

class ResourceController
{
    public function GetResources(){
        $service = new ResourceService();
        $resources = $service->GetUserResources($_SESSION['UserId']);

        return $resources;
    }
}