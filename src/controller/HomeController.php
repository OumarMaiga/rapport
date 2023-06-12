<?php

namespace Controller;

use Exception;
use Model\AdministratorModel;
use Sabo\Controller\Controller\SaboController;
use Sabo\Middleware\Exception\MiddlewareException;
use Sabo\Model\Exception\ModelCondException;
use Sabo\Model\Model\SaboModel;
use Sabo\Model\System\Mysql\MysqlReturn;
use Sabo\Model\System\QueryBuilder\QueryBuilder;
use Sabo\Model\System\QueryBuilder\SqlComparator;
use Sabo\Model\System\QueryBuilder\SqlSeparator;

/**
 * Accueil
 * @name HomeController
 */
class HomeController extends SaboController{
    
    public function test($id):void
    {
        $admin_model = new AdministratorModel();
        try {
            //$admin_model->setAttribute("username", "Oumar Maiga")->insert();
            //var_dump(AdministratorModel::find(["id" => 1])[0]);
            
            $queryBuilder = QueryBuilder::createFrom(AdministratorModel::class);
            $queryBuilder
                ->select("username")
                ->where()
                ->whereCond("username", "Oumar Mai%", SqlComparator::LIKE)
                ->limit(2, 0);

            var_dump(SaboModel::execQuery($queryBuilder, MysqlReturn::DEFAULT));die;

        } catch (ModelCondException $e) {
            $this->getErrorMessageFrom(new MiddlewareException($e->getMessage()));
        }
        $this->render('home/index.twig',["id"=>$id]);
    }

    public function home():void
    {
        $this->redirectToRoute('Template:index');
    }
    
    public function create():void
    {
        $this->render('home/index.twig');
    }
}