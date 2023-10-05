<?php
require __DIR__ .'/../vendor/autoload.php';
session_start();

const AVAIABLE_ROUTES = [
    'home'=> [
        'action' => 'render',
        'controller' => 'HomeController',
    ],
    'about'=> [
        'action' => 'render',
        'controller' => 'MainController',
    ],
    'contact'=> [
        'action' => 'renderContact',
        'controller' => 'ContactController',
    ],
    'adopt'=> [
        'action' => 'renderAdopt',
        'controller' => 'AdoptController',
    ],
    'animal'=> [
        'action' => 'renderAnimal',
        'controller' => 'AnimalController',
    ],
    'login'=>[
        'action' => 'renderUser',
        'controller' => 'UserController'
    ],
    'logout'=>[
        'action' => 'renderUser',
        'controller' => 'UserController'
    ],
    'register'=>[
        'action' => 'renderUser',
        'controller' => 'UserController'
    ],
    'admin'=>[
        'action' => 'renderAdmin',
        'controller' => 'AdminController'
    ],
    'add'=>[
        'action' => 'renderAdmin',
        'controller' => 'AdminController'
    ],
];

$page = 'home';
$subPage=null;
$controller;
$action;
$id=null;

if(isset($_GET['page']) && !empty($_GET['page'])){    
    $page = $_GET['page'];
    
     if(!empty($_GET['subpage'])){
        $subPage = $_GET['subpage'];
        if(!empty($_GET['id'])){
            $id = $_GET['id'];
        }
    }
}else{
    $page = 'home';    
}

if(array_key_exists($page, AVAIABLE_ROUTES)){
    $controller = AVAIABLE_ROUTES[$page]['controller'];
    $action = AVAIABLE_ROUTES[$page]['action'];
} else {
    $page = '404';
    $controller = 'ErrorController';
    $render = 'render';
}

$namespace = 'App\Controllers';
$namespaceController = $namespace.'\\'.$controller;

$pageController = new $namespaceController();
$pageController->setView($page);
$pageController->setSubPage($subPage);
$pageController->setId($id);
$pageController->$action();