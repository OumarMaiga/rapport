<?php

namespace Controller;

use Exception;
use Helper\Helper;
use Helper\HumanoService;
use Middleware\Middleware\TemplateManager;
use Sabo\Config\SaboConfig;
use Sabo\Config\SaboConfigAttributes;
use Sabo\Controller\Controller\SaboController;
use Sabo\Middleware\Exception\MiddlewareException;
use Sabo\Model\Exception\ModelCondException;
use Spipu\Html2Pdf\Html2Pdf;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Accueil
 * @name RapportController
 */
class RapportController extends SaboController {    
    
    public function index():void
    {
        $templateManager = new TemplateManager();
        $this->render('rapport/index.twig',[
            "templates" => $templateManager->getTemplates(),
            "successMessage" => $this->getFlashData('template:successMessage')
        ]);
    }

    public function local_edit($ref):void
    {
        $data = file_get_contents(ROOT . "bimProjects.json");

        $data = $data ? json_decode($data,true) : [];
            
        try {
            $templateManager = new TemplateManager();        
            $templateData = $templateManager->getBySlug($ref);
            Helper::applyDataToTemplate($templateData['overview'], $data['data'][0]);
        } catch (ModelCondException $e) {
            $this->getErrorMessageFrom(new MiddlewareException($e->getMessage()));
        }
        $this->render('rapport/edit.twig',[
            "rapport" => $templateData
        ]);
    }

    public function edit($ref):void
    {
        $data = HumanoService::getBimService($ref);

        if (empty($data)) die("Catalogue non trouvé dans humano...");
        
        try {
            $templateManager = new TemplateManager();        
            $templateData = $templateManager->getByCatalog($data['sysBusinessCatalogItem']['id']);
            if (empty($templateData)) die("Catalogue ne correspond à aucun template...");
            Helper::applyDataToTemplate($templateData['overview'], $data);
        } catch (ModelCondException $e) {
            $this->getErrorMessageFrom(new MiddlewareException($e->getMessage()));
        }
        $this->render('rapport/edit.twig',[
            "rapport" => $templateData
        ]);
    }

    public function export_pdf($name):void
    {
        $pdfCreator = new Html2Pdf();

        $loader = new FilesystemLoader(__DIR__ . "/../view");

        $twig = new Environment($loader,[
            "debug" => SaboConfig::getBoolConfig(SaboConfigAttributes::DEBUG_MODE)
        ]);
        
        $pdfCreator->writeHTML($twig->render("/rapport/document.twig",["rapport" => $_POST["rapport"]]));
        
        $pdfCreator->output($name.'.pdf');
    }

}