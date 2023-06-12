<?php

use Controller\HomeController;
use Controller\RapportController;
use Controller\TemplateController;
use Helper\Helper;
use Middleware\RoutesCond\Admin;
use Sabo\Helper\Regex;
use Sabo\Sabo\Route;

// routes à placer ici
return Route::generateFrom([
    
    Route::get("/", [HomeController::class, "home"], "home"),

    Route::group('/rapport', [  
        Route::get("/", [RapportController::class, "index"], "Rapport:index"),
        Route::get("/{template}/edit", [RapportController::class, "edit"], "Rapport:edit"),
        Route::post("/export-pdf/{name}", [RapportController::class, "export_pdf"], "Rapport:export_pdf")
    ]),
    Route::group('/template', [  
        Route::get("/", [TemplateController::class, "index"], "Template:index"),
        Route::get("/create", [TemplateController::class, "create"], "Template:create"),
        Route::post("/", [TemplateController::class, "store"], "Template:store"),
        Route::get("/{template}/edit", [TemplateController::class, "edit"], "Template:edit"),
        Route::post("/{template}/update", [TemplateController::class, "update"], "Template:update"),
        Route::get("/{template}/delete", [TemplateController::class, "delete"], "Template:delete"),
        Route::get("/{template}", [TemplateController::class, "show"], "Template:show")
    ]),

    Route::getFromFile('admin'),
    Route::get("/article/{id}",function(int $id):void{
        echo "article numero : {$id}";
    },"Article",["id" => Regex::strRegex() ]),

    Route::get("/home/index/{id}", [HomeController::class, "test"], "test", ["id"=> ".*"], [Admin::class, fn() => true]),

    Route::group('/admin', [
        Route::get('/create', [HomeController::class, "create"], "create_admin")
        ], [Admin::class, fn() => false]
    )

]);
