<?php
    
    require_once 'libs/router.php';
    require_once 'app/Controllers/juego.api.controller.php';
    require_once 'app/Controllers/pedido.api.controller.php';


    $router = new Router();

 #                 endpoint         verbo      controller              metodo
 $router->addRoute('juego',         'GET' ,   'JuegoApiController',     'getAll');
 $router->addRoute('juego/:id',     'GET',    'JuegoApiController',     'get');
 $router->addRoute('juego/:id',     'DELETE', 'JuegoApiController',     'delete');
 $router->addRoute('juego',         'POST',   'JuegoApiController',     'create');
 $router->addRoute('juego/:id',     'PUT',    'JuegoApiController',     'update');
 $router->addRoute('pedidos/:id',   'GET',    'PedidoApiController',    'get');
 $router->addRoute('pedidos/:id',   'DELETE', 'PedidoApiController',    'delete');
 $router->addRoute('pedidos/:id',   'POST',   'PedidoApiController',    'create');
 $router->addRoute('pedidos/:id',   'PUT',    'PedidoApiController',    'update');

 $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
