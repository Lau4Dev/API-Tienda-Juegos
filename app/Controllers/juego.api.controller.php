<?php
require_once './app/Models/juego.api.model.php';
require_once './app/Views/json.view.php';
require_once './app/Models/pedido.api.model.php';

class JuegoApiController{
    private $model;
    private $modelP;
    private $view;

    public function __construct(){
        $this->model = new JuegoApiModel();
        $this->modelP = new PedidoApiModel();
        $this->view = new JSONView();
    }

    public function getAll($req, $res){
        
        //Para preguntar
        $filtrarGenero = null;
        
        if(isset($req->query->genero)) {
            $filtrarGenero = $req->query->genero;//ejemplo: juego?genero=accion
        }

        $orderBy = false;

        if(isset($req->query->orderBy)){
            $orderBy = $req->query->orderBy;//ejemplo: juego?orderBy=nombre_juego
        }

        $order = null;

        if(isset($req->query->order)){
            $order = $req->query->order;//ejeplo: juego?orderBy=nombre_juego
        }

        $juegos = $this->model->getJuegos($filtrarGenero,$orderBy, $order);

        return $this->view->response($juegos);
    }

    public function get($req, $res){
        $id = $req->params->Id_Juego;
        $juego = $this->model->getJuegoById($id);

        if(!$juego){
            return $this->view->response("El juego con el id = $id no existe", 404);
        }

        return $this->view->response($juego);
    }

    public function delete($req, $res){
        $id = $req->params->Id_Juego;
        $juego = $this->model->getJuegoById($id);
        
        if(!$juego){
            return $this->view->response("El juego con el id = $id no existe", 404);
        }

        $tienePedidos = $this->modelP->getPedidos($id);
        
        if($tienePedidos){
            return $this->view->response("El juego con el id = $id no se puede borrar porq 
                                        tiene pedidos asociados", 400);
        }

        $this->model->deleteJuego($id);
        return $this->view->response("el juego con el id = $id se elimino con exito");
    }

    public function create($req, $res){

        if(empty($req->body->nombre_juego)||empty($req->body->generos)||empty($req->body->califiacion)){
            return $this->view->response("Faltan completar datos", 400);
        }

        $nombre = $req->body->nombre_juego;
        $generos = $req->body->generos;
        $calificacion = $req->body->califiacion;

        $juego = $this->model->insertJuego($nombre,$generos,$calificacion);

        if(!$juego){
            return $this->view->response("Error al insertar el juego", 500);
        }

        $resultado = $this->model->getJuegoById($juego);
        return $this->view->response($resultado,201);
    }
    public function update($req,$res){
        $id=$req->params->Id_Juego;

        $juego = $this->model->getJuegoById($id);

        if(!$juego){
            return $this->view->response("El juego con el id=$id no existe",404);
        }

        if(empty($req->body->nombre_juego)||empty($req->body->generos)||empty($req->body->califiacion)){
            return $this->view->response("Faltan completar datos",400);
        }

        $nombre = $req->body->nombre_juego;
        $generos = $req->body->generos;
        $calificacion = $req->body->califiacion;

        $this->model->updateJuego($id,$nombre,$generos,$calificacion);

        $resultado = $this->model->getJuegoById($id);
        $this->view->response($resultado,200);
    }
}