<?php session_start();
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
use Sabo\Config\PathConfig;
use Sabo\Config\SaboConfig;
use Sabo\Helper\FileHelper;
use Sabo\Helper\Helper;
use Sabo\Sabo\Router;

define("ROOT",__DIR__ . "/../");
define("APP_URL","http://humano-private-ebax.cratechnologie.com");

require_once(__DIR__ . "/vendor/autoload.php");

// inclusion de l'autoloader utilisateur
if(FileHelper::fileExist(PathConfig::USER_AUTOLOAD_FILEPATH->value) ) Helper::require(PathConfig::USER_AUTOLOAD_FILEPATH->value);

// définition des configurations par défaut
SaboConfig::setDefaultConfigurations();

// inclusion des configurations utilisateur ainsi que des fonctions utiles
Helper::require(PathConfig::SABO_FUNCTIONS_FILEPATH->value);
Helper::require(PathConfig::SABO_CONFIG_FILEPATH->value);

// démarrage du site
Router::initWebsite();