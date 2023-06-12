<?php

namespace Controller;

use Exception;
use Middleware\Middleware\TemplateManager as MiddlewareTemplateManager;
use Model\AdministratorModel;
use Model\TemplateModel;
use Sabo\Controller\Controller\SaboController;
use Sabo\Middleware\Exception\MiddlewareException;
use Sabo\Model\Exception\ModelCondException;
use Sabo\Model\Model\SaboModel;
use Sabo\Model\System\Mysql\MysqlReturn;
use Sabo\Model\System\QueryBuilder\QueryBuilder;
use Sabo\Model\System\QueryBuilder\SqlComparator;

/**
 * Accueil
 * @name AdministratorController
 */
class AdministratorController extends SaboController{
    
}