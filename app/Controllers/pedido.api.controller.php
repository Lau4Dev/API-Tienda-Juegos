<?php

class PedidoApiController{
    private $model;
    private $view;

    public function __construct(){
        $this->model = new PedidoApiModel();
        $this->view = new JSONView();
    }
    

    public function getAll($req, $res){

        $pedidos = $this->model->getPedidos();

        return $this->view->response($pedidos);
    }
    public function get($req, $res){
        $idJuego = $req->params->Id_Juego;

        $pedidos = $this->model->getPedidosByJuego($idJuego);

        if(!$pedidos){
            return $this->view->response("No se encontraron pedidos asociado al juego con el id = $idJuego", 404);
        }

        return $this->view->response($pedidos);
    }

    public function delete($req, $res){
        $id = $req->params->id_pedido;

        $pedidos = $this->model->getPedidoById($id);

        if(!$pedidos){
            return $this->view->response("No se encontro el pedido con el id = $id", 404);
        }

        $this->model->deletePedido($id);
        $this->view->response("El pedido se elimino con exito");
    }

    public function create($req, $res){
        //Para preguntar
        $idJuego = $req->params->Id_Juego;

        //Para preguntar
        if(!$idJuego){
            return $this->view->response("No existe el juego con el id = $idJuego", 404);
        }

        if(empty($req->body->cantidad) || empty($req->body->precio)){
            return $this->view->response("Faltan datos por completar", 400);
        }

        $cantidad = $req->body->cantidad;
        $precio = $req->body->precio;

        $id = $this->model->insertPedido($idJuego,$cantidad,$precio);

        if(!$id){
            return $this->view->response("No se pudo crear el pedido", 500);
        }
        
        $this->view->response("Se creo el pedido con exito", 201);
        $resultado = $this->model->getPedidoById($id);
        return $resultado;
    }

    public function update($req, $res){
        $id = $req->params->id_pedido;

        $pedido = $this->model->getPedidoById($id);

        if(!$pedido){
            return $this->view->response("No existe el pedido con el id = $id", 404);
        }

        if(empty($req->body->cantidad) || empty($req->body->precio)){
           return $this->view->response("Faltan completar datos", 400);
        }

        $cantidad = $req->body->cantidad;
        $precio = $req->body->precio;

        $this->model->updatePedido($id, $cantidad, $precio);
        
        $resultado = $this->model->getPedidoById($id);
        $this->view->response($resultado,200);
    }
}