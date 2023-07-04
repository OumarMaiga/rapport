<?php

namespace Controller;

use Exception;
use Middleware\Middleware\TemplateManager;
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
 * @name TemplateController
 */
class TemplateController extends SaboController 
{
    
    public function index():void
    {
        $templateManager = new TemplateManager();
        $this->render('administrator/template/index.twig',[
            "templates" => $templateManager->getTemplates(),
            "successMessage" => $this->getFlashData('template:successMessage')
        ]);
    }

    public function create():void
    {       
        $this->render('administrator/template/create.twig',[
            "errorMessage" => $this->getFlashData('template:errorMessage'),
            "template" => $this->getFlashData("template:templateData")
        ]);
    }

    public function store():void
    {
        $templateManager = new TemplateManager();
        try {
            $templateManager->store();
        } catch (MiddlewareException $e) {
            $this->setFlashData("template:templateData", $_POST);
            $this->setFlashData("template:errorMessage", $e->getMessage());
            $this->redirectToRoute('Template:create');
        }
        $this->redirectToRoute('Template:index',[
            "sucessMessage" => "Template saved!"
        ]);
    }

    public function show($template):void
    {
        $templateManager = new TemplateManager();

        $this->render('administrator/template/show.twig',[
            "template" => $templateManager->getById($template)
        ]);
    }

    public function edit($template):void
    {
        $templateManager = new TemplateManager();

        $templateData = $this->getFlashData("template:templateData");

        if($templateData == NULL)
            $templateData = $templateManager->getById($template);

        $this->render('administrator/template/edit.twig',[
            "successMessage" => $this->getFlashData('template:successMessage'),
            "errorMessage" => $this->getFlashData('template:errorMessage'),
            "template" => $templateData
        ]);
    }

    public function update($template):void
    {
        $templateManager = new TemplateManager();
        try {
            $templateManager->update($template);
            $this->setFlashData("template:successMessage", "Template edited!");
        } catch (MiddlewareException $e) {
            $this->setFlashData("template:templateData", array_merge(["id"=>$template],$_POST));
            $this->setFlashData("template:errorMessage", $e->getMessage());
        }
        $this->redirectToRoute('Template:edit',["template"=>$template]);
    }
    

    public function delete($template):void
    {
        $templateManager = new TemplateManager();
        try {
            $templateManager->delete($template);
            $this->setFlashData("template:successMessage", "Template deleted!");
        } catch (MiddlewareException $e) {
            $this->setFlashData("template:errorMessage", $e->getMessage());
        }
        $this->redirectToRoute('Template:index',["template"=>$template]);
    }
}