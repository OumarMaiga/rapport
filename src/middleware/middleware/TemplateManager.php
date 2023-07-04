<?php

namespace Middleware\Middleware;

use Helper\Helper;
use Model\AdministratorModel;
use Model\TemplateModel;
use Sabo\Middleware\Exception\MiddlewareException;
use Sabo\Middleware\Middleware\SaboMiddleware;
use Sabo\Model\Exception\ModelCondException;
use Sabo\Model\Model\SaboModel;
use Sabo\Model\System\Mysql\MysqlReturn;
use Sabo\Model\System\QueryBuilder\QueryBuilder;
use TypeError;

class TemplateManager extends SaboMiddleware
{

    /**
     * Recuperer la liste des templates
     * 
     * @return void
     */
    public function getTemplates():array
    {
        $templateData = [];
        try {
            
            $result = TemplateModel::find();

            foreach($result as $data)
            {
                array_push($templateData, [
                    "id" => $data->getAttribute("id"),
                    "title" => $data->getAttribute("title"),
                    "slug" => $data->getAttribute("slug"),
                    "overview" => $data->getAttribute("overview"),
                    "status" => $data->getAttribute("status"),
                    "catalog_id" => $data->getAttribute("catalog_id"),
                    "created_by" => $data->getAttribute("created_by"),
                    "created_at" => $data->getAttribute("created_at"),
                    "updated_at" => $data->getAttribute("updated_at")
                ]);
            }
            
        } catch (TypeError $e) {
            $this->throwException($e->getMessage());
        }
        return $templateData;
    }

    /**
     * Recuperer le template par son id
     * 
     * @return void
     */
    public function getById($template):array
    {
        $templateData = [];
        try {
            
            $result = TemplateModel::find(["id" => $template]);

            if(!empty($result))
            {
                $result = $result[0];
                $templateData = [
                    "id" => $result->getAttribute("id"),
                    "title" => $result->getAttribute("title"),
                    "slug" => $result->getAttribute("slug"),
                    "overview" => $result->getAttribute("overview"),
                    "status" => $result->getAttribute("status"),
                    "catalog_id" => $result->getAttribute("catalog_id"),
                    "created_by" => $result->getAttribute("created_by"),
                    "created_at" => $result->getAttribute("created_at"),
                    "updated_at" => $result->getAttribute("updated_at")
                ];
            }
            
        } catch (TypeError $e) {
            $this->throwException($e->getMessage());
        }
        return $templateData;
    }

    /**
     * Recuperer le template par son slug
     * 
     * @return void
     */
    public function getBySlug($template):array
    {
        $templateData = [];
        try {
            
            $result = TemplateModel::find(["slug" => $template]);

            if(!empty($result))
            {
                $result = $result[0];
                $templateData = [
                    "id" => $result->getAttribute("id"),
                    "title" => $result->getAttribute("title"),
                    "slug" => $result->getAttribute("slug"),
                    "overview" => $result->getAttribute("overview"),
                    "status" => $result->getAttribute("status"),
                    "catalog_id" => $result->getAttribute("catalog_id"),
                    "created_by" => $result->getAttribute("created_by"),
                    "created_at" => $result->getAttribute("created_at"),
                    "updated_at" => $result->getAttribute("updated_at")
                ];
            }
            
        } catch (TypeError $e) {
            $this->throwException($e->getMessage());
        }
        return $templateData;
    }

    /**
     * Recuperer le template par son catalog_id
     * 
     * @return void
     */
    public function getByCatalog($template):array
    {
        $templateData = [];
        try {
            
            $result = TemplateModel::find(["catalog_id" => $template]);

            if(!empty($result))
            {
                $result = $result[0];
                $templateData = [
                    "id" => $result->getAttribute("id"),
                    "title" => $result->getAttribute("title"),
                    "slug" => $result->getAttribute("slug"),
                    "overview" => $result->getAttribute("overview"),
                    "status" => $result->getAttribute("status"),
                    "catalog_id" => $result->getAttribute("catalog_id"),
                    "created_by" => $result->getAttribute("created_by"),
                    "created_at" => $result->getAttribute("created_at"),
                    "updated_at" => $result->getAttribute("updated_at")
                ];
            }
            
        } catch (TypeError $e) {
            $this->throwException($e->getMessage());
        }
        return $templateData;
    }

    /**
     * Enregistrer un template
     * 
     * @return void
     */
    public function store():void
    {
        $template_model = new TemplateModel();
        try {            
            if(empty($_POST["title"]) )
                $this->throwException("Veuillez remplir tous les champs requis");

            $slug = Helper::generateSlug($_POST['title']);

            if(!empty($this->getById($slug)))
                $this->throwException("Ce template existe déjà");

            $template_model
                ->setAttribute("title", $_POST["title"])
                ->setAttribute("slug", $slug)
                ->setAttribute("overview", $_POST["overview"])
                ->setAttribute("catalog_id", $_POST["catalog_id"])
                ->setAttribute("status", $_POST["status"]);

            if(!$template_model->create())
                $this->throwException("Une erreur technique est survenue");

        } catch (MiddlewareException $e) {
            $this->throwException($e->getMessage());
        }catch (ModelCondException $e) {
            $this->throwException($e->getMessage());
        }
    }

    /**
     * Modifier un template
     * 
     * @return void
     */
    public function update($template):void
    {
        try {
            
            if(empty($_POST["title"]) )
                $this->throwException("Veuillez remplir tous les champs requis");

            if(empty($this->getById($template)))
                $this->throwException("Ce template n'existe pas");
                
            /*$queryBuilder = QueryBuilder::createFrom(TemplateModel::class);
            $queryBuilder
                ->select()
                ->where()
                ->whereCond("id", $template);

            $templateModel = SaboModel::execQuery($queryBuilder, MysqlReturn::OBJECTS);
            Ou */
            
            $templateModel = TemplateModel::find(["id" => $template]);  

            $templateModel = $templateModel[0];
                
            $templateModel
                ->setAttribute("title", $_POST["title"])
                ->setAttribute("overview", $_POST["overview"])
                ->setAttribute("catalog_id", $_POST["catalog_id"])
                ->setAttribute("status", $_POST["status"]);

            if(!$templateModel->update())
                $this->throwException("Une erreur technique est survenue");

        } catch (MiddlewareException $e) {
            $this->throwException($e->getMessage());
        }catch (ModelCondException $e) {
            $this->throwException($e->getMessage());
        }
    }

    /**
     * Supprimer un template
     * 
     * @return void
     */
    public function delete($template):void
    {
        try {
            
            $templateModel = TemplateModel::find(["id" => $template]);
            
            if(empty($templateModel))
                $this->throwException("Ce template n'existe pas");
            else
                $templateModel = $templateModel[0];

            if(!$templateModel->delete())
                $this->throwException("Une erreur technique est survenue");

        } catch (MiddlewareException $e) {
            $this->throwException($e->getMessage());
        }
    }
}