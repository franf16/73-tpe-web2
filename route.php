<?php

require_once './libs/router/Router.class.php';
require_once './mvc/controllers/Noticia.controller.php';
require_once './mvc/controllers/Seccion.controller.php';
require_once './mvc/controllers/Usuario.controller.php';
require_once './mvc/controllers/Comentario.controller.php';
require_once './mvc/controllers/AdminController.php';

define('BASE_URL', "//{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}" . dirname($_SERVER['PHP_SELF']) . '/');
define('HOME', '');
define('LOGIN', 'login');
define('ADMIN', 'admin');
define('SECCION', 'seccion');
define('NOTICIA', 'noticia');
define('THIS_URL', $_GET[ 'action' ] . '?' . array_reduce(array_keys($_GET), fn ($carry, $key) => ($key != 'action') ? $carry .= "$key={$_GET[ $key ]}" . ($key != array_key_last($_GET) ? '&' : '') : null)); // para paginator

$router = new Router();
// $router->setDefaultRoute('controller', 'method');
// $router->addRoute('url', 'verb', 'controller', 'method');

$router->setDefaultRoute('NoticiaController', 'showHome');

$router->addRoute('noticias',               'GET',  'NoticiaController',    'showHome');
$router->addRoute('buscar',                 'GET',  'NoticiaController',    'showResultados');
$router->addRoute('noticia/:ID',            'GET',  'NoticiaController',    'showNoticiaRedirect');
$router->addRoute('noticia/:ID/:TITULO',    'GET',  'NoticiaController',    'showNoticia');

$router->addRoute('secciones',              'GET',  'SeccionController',    'showSecciones');
$router->addRoute('seccion/:ID',            'GET',  'SeccionController',    'showSeccionRedirect');
$router->addRoute('seccion/:ID/:TITULO',    'GET',  'SeccionController',    'showSeccion');

$router->addRoute('login',                  'GET',  'UsuarioController',    'showLogin');
$router->addRoute('login',                  'POST', 'UsuarioController',    'login');
$router->addRoute('logout',                 'GET',  'UsuarioController',    'logout');

/** ABM */

$router->addRoute('agregar/noticia',        'GET',  'NoticiaController',    'showElementForm');
$router->addRoute('noticia',                'POST', 'NoticiaController',    'postElement');
$router->addRoute('editar/noticia/:ID',     'GET',  'NoticiaController',    'showElementForm');
$router->addRoute('noticia/:ID',            'POST', 'NoticiaController',    'postElement');
$router->addRoute('eliminar/noticia/:ID',   'GET',  'NoticiaController',    'deleteElement');

$router->addRoute('agregar/seccion',        'GET',  'SeccionController',    'showElementForm');
$router->addRoute('seccion',                'POST', 'SeccionController',    'postElement');
$router->addRoute('editar/seccion/:ID',     'GET',  'SeccionController',    'showElementForm');
$router->addRoute('seccion/:ID',            'POST', 'SeccionController',    'postElement');
$router->addRoute('eliminar/seccion/:ID',   'GET',  'SeccionController',    'deleteElement');

$router->addRoute('agregar/usuario',        'GET',  'UsuarioController',    'showElementForm');
$router->addRoute('usuario',                'POST', 'UsuarioController',    'postElement');
$router->addRoute('editar/usuario/:ID',     'GET',  'UsuarioController',    'showElementForm');
$router->addRoute('usuario/:ID',            'POST', 'UsuarioController',    'postElement');
$router->addRoute('eliminar/usuario/:ID',   'GET',  'UsuarioController',    'deleteElement');

$router->addRoute('agregar/comentario',     'GET',  'ComentarioController', 'showElementForm');
$router->addRoute('comentario',             'POST', 'ComentarioController', 'postElement');
$router->addRoute('editar/comentario/:ID',  'GET',  'ComentarioController', 'showElementForm');
$router->addRoute('comentario/:ID',         'POST', 'ComentarioController', 'postElement');
$router->addRoute('eliminar/comentario/:ID','GET',  'ComentarioController', 'deleteElement');

$router->addRoute('admin',                  'GET',  'AdminController',      'showPanel');
$router->addRoute('admin/:TABLE',           'GET',  'AdminController',      'showPanel');

// route 
$router->route($_GET[ 'action' ], $_SERVER[ 'REQUEST_METHOD' ]);