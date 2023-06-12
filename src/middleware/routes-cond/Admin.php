<?php

namespace Middleware\RoutesCond;

use Sabo\Controller\Controller\SaboController;
use Sabo\Middleware\Middleware\SaboMiddlewareCond;

class Admin implements SaboMiddlewareCond{

    public static function verify():bool
    {
        return true;
    }

    public static function toDoOnFail():void 
    {
        SaboController::redirectToLink('https://oumarmaiga.dev');
    }
}