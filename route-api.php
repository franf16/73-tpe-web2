<?php

require_once './libs/router/Router.class.php';
require_once './api/Usuario.api.controller.php';

define('BASE_URL', "//{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}" . dirname($_SERVER['PHP_SELF']) . '/');
define('LOGIN', 'login');
define('ADMIN', 'admin');
define('THIS_URL', $_GET[ 'resource' ] . '?' . array_reduce(array_keys($_GET), fn ($carry, $key) => ($key != 'action') ? $carry .= "$key={$_GET[ $key ]}" . ($key != array_key_last($_GET) ? '&' : '') : null)); // para paginator

$router = new Router();
// $router->setDefaultRoute('controller', 'method');
// $router->addRoute('url', 'verb', 'controller', 'method');

// $router->setDefaultRoute('UsuarioController', 'showLogin');

$router->addRoute('usuarios', 'GET', 'UsuarioAPIController', 'GET');

// route 
$router->route($_GET[ 'resource' ], $_SERVER[ 'REQUEST_METHOD' ]);