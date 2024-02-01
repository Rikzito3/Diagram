<?php

require_once('../vendor/autoload.php');
// require_once '../IpeWeb/Diagram/Bootstrap/Request';

use Ipeweb\Diagram\Controllers\ProjectsController;
use Ipeweb\Diagram\Controllers\BanksController;
use Ipeweb\Diagram\Controllers\AtribuctsController;
use Ipeweb\Diagram\Controllers\DiagramsController;
use Ipeweb\Diagram\Controllers\ElementsDiagramsController;
use Ipeweb\Diagram\Controllers\ExportsController;
use Ipeweb\Diagram\Bootstrap\Request;
use Ipeweb\Diagram\Controllers\UsersController;
use Ipeweb\Diagram\Resources\ElementsDiagrams;

Request::init();

$uri = $_SERVER['REQUEST_URI'];

$routes = [
    '/projects' => [ProjectsController::class, 'index'],
    '/projects/create' => [ProjectsController::class, 'store'],
    '/projects/update' => [ProjectsController::class, 'update'],
    '/projects/desactivate' => [ProjectsController::class, 'destroy'],
    '/projects/show' => [ProjectsController::class, 'show'],

    '/banks' => [BanksController::class, 'listBanks'],
    '/banks/create' => [BanksController::class, 'createBank'],
    '/banks/update' => [BanksController::class, 'updateBank'],
    '/banks/desactivate' => [BanksController::class, 'deactivateBank'],

    '/diagrams' => [DiagramsController::class, 'listDiagrams'],
    '/diagrams/create' => [DiagramsController::class, 'createDiagram'],
    '/diagrams/update' => [DiagramsController::class, 'updateDiagram'],
    '/diagrams/desactivate' => [DiagramsController::class, 'desactivateDiagram'],

    '/elements-diagrams' => [ElementsDiagramsController::class, 'listElements'],
    '/elements-diagrams/create' => [ElementsDiagramsController::class, 'createElement'],
    '/elements-diagrams/update' => [ElementsDiagramsController::class, 'updateElement'],
    '/elements-diagrams/desactivate' => [ElementsDiagramsController::class, 'desactivateElement'],

    '/exports' => [ExportsController::class, 'index'],
    '/exports/create' => [ExportsController::class, 'store'],
    '/exports/update' => [ExportsController::class, 'update'],
    '/exports/desactivate' => [ExportsController::class, 'destroy'],

    '/atribucts' => [AtribuctsController::class, 'index'],
    '/atribucts/create' => [AtribuctsController::class, 'store'],
    '/atribucts/update' => [AtribuctsController::class, 'update'],
    '/atribucts/desactivate' => [AtribuctsController::class, 'destroy'],

    '/users' => [UsersController::class, 'index'],
    '/users/create' => [UsersController::class, 'store'],
    '/users/update' => [UsersController::class, 'update'],
    '/users/desactivate' => [UsersController::class, 'destroy'],

    '/elementsdiagrams' => [ElementsDiagrams::class, 'index'],
    '/elementsdiagrams/create' => [ElementsDiagrams::class, 'store'],
    '/elementsdiagrams/update' => [ElementsDiagrams::class, 'update'],
    '/elementsdiagrams/desactivate' => [ElementsDiagrams::class, 'destroy'],
];

if (array_key_exists($uri, $routes)) {
    [$controller, $action] = $routes[$uri];
    $controllerInstance = new $controller();
    $controllerInstance->$action();
} else {
    Request::handle404();
}
