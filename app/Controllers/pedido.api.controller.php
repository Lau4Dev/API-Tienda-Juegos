<?php

class PedidoApiController{
    private $model;
    private $view;

    public function __construct(){
        $this->model = new PedidoModel();
        $this->view = new JSONView();
    }

    public function get($req, $res){
        $idJuego = $req->params->Id_Juego;

        $pedidos = $this->model->getPedidos($idJuego);

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

        $this->model->detelePedido($id);
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

        $this->model->insertPedido($idJuego,$cantidad,$precio);
        
    }
}