<?php

namespace Controller;

use Sabo\Controller\TwigExtension\SaboExtension;
use Twig\TwigFunction;

class Service extends SaboExtension {

    public function getFunctions():array{
        return [
            new TwigFunction("getServicee", [$this,"getService"]),
        ];
    }

    /**
     * fonction visant à initialiser les ressources nécéssaires à l'extension peut être vide
     */
    public static function initExtension():void
    {

    }

    public function getService()
    {
        return "Bonjour";
    }
}