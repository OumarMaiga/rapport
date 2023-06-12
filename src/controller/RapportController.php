<?php

namespace Controller;

use Helper\Helper;
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

    public function edit($template):void
    {
        $data = file_get_contents(ROOT . "data.json");

        $data = $data ? json_decode($data,true) : [];
            
        try {
            $templateManager = new TemplateManager();        
            $templateData = $templateManager->getById($template);
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