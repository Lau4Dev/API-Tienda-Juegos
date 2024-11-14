<?php
    
    require_once 'libs/router.php';
    require_once 'app/Controllers/juego.api.controller.php';
    require_once 'app/Controllers/pedido.api.controller.php';


    $router = new Router();

 #                 endpoint               verbo      controller                metodo
 $router->addRoute('juego',               'GET' ,   'JuegoApiController',     'getAll');
 $router->addRoute('juego/:Id_Juego',     'GET',    'JuegoApiController',     'get');
 $router->addRoute('juego/:Id_Juego',     'DELETE', 'JuegoApiController',     'delete');
 $router->addRoute('juego',               'POST',   'JuegoApiController',     'create');
 $router->addRoute('juego/:Id_Juego',     'PUT',    'JuegoApiController',     'update');
 $router->addRoute('pedidos',             'GET' ,   'PedidoApiController',    'getAll');
 $router->addRoute('pedidos/:Id_Juego',   'GET',    'PedidoApiController',    'get');
 $router->addRoute('pedidos/:id_pedido',  'DELETE', 'PedidoApiController',    'delete');
 $router->addRoute('pedidos/:Id_Juego',   'POST',   'PedidoApiController',    'create');
 $router->addRoute('pedidos/:id_pedido',  'PUT',    'PedidoApiController',    'update');

 $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
