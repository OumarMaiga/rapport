<?php

use Controller\Service;
use Sabo\Config\SaboConfig;
use Sabo\Config\SaboConfigAttributes;

SaboConfig::setBoolConfig(SaboConfigAttributes::DEBUG_MODE,true);
SaboConfig::setBoolConfig(SaboConfigAttributes::INIT_WITH_DATABASE_CONNEXION,true);
SaboConfig::setUserExtensions([Service::class]);
// SaboConfig::setStrConfig(SaboConfigAttributes::ENV_FILE_TYPE,".env");