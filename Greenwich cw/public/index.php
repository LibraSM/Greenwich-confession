<?php
declare(strict_types=1);
session_start();

require_once __DIR__ . '/../app/Controllers/PostsController.php';
require_once __DIR__ . '/../app/Controllers/UsersController.php';
require_once __DIR__ . '/../app/Controllers/ModulesControllers.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Core/Flash.php';

$controllerName = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

switch ($controllerName) {
    case 'modules':
        $controller = new ModulesControllers();
        break;
    case 'posts':
        $controller = new PostsController();
        break;
    case 'users':
        $controller = new UsersController();
        break;
    case 'auth':
        $controller = new AuthController();
        break;
    case 'home':
        $controller = new HomeController();
        break;
    default:
        $controller = new HomeController();
        $controllerName = 'home';
        break;
}

switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'show':
        $controller->show((int)($_GET['id'] ?? 0));
        break;
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store();
        break;
    case 'edit':
        if ($controllerName === 'auth') {
            $controller->edit();
        } else {
            $controller->edit((int)($_GET['id'] ?? 0));
        }
        break;
    case 'update':
        if ($controllerName === 'auth') {
            $controller->update();
        } else {
            $controller->update((int)($_GET['id'] ?? 0));
        }
        break;
    case 'delete':
        $controller->delete((int)($_GET['id'] ?? 0));
        break;
    case 'login':
        $controller->login();
        break; 
    case 'authenticate':
        $controller->authenticate();
        break; 
    case 'logout':
        $controller->logout();
        break;
    case 'register':
        $controller->register();
        break;
    case 'profile':
        $controller->profile();
        break;
    default:
        $controller->index();
        break;
}
