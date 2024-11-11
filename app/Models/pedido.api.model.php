<?php

class PedidoApiModel{
    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost; dbname=tiendajuegos; charset=utf8', 'root', '');
    }

    public function getPedidos($idJuego){
        $query = $this->db->prepare('SELECT * FROM pedidojuegos WHERE Id_Juego = ?');
        $query->execute([$idJuego]);

        $pedidos = $query->fetchAll(PDO::FETCH_OBJ);

        return $pedidos;
    }

    public function getPedidoById($id){
        $query = $this->db->prepare('SELECT * FROM pedidojuegos WHERE id_pedido = ?');
        $query->execute([$id]);

        $pedido = $query->fetch(PDO::FETCH_OBJ);

        return $pedido;
    }

    public function deletePedido($id){
        $query = $this->db->prepare('DELETE FROM pedidojuegos WHERE id_pedido = ?');
        $query->execute([$id]);
    }

    public function insertPedido($idJuego, $cantidad, $precio){
        $query = $this->db->prepare('INSERT INTO pedidosjuego(cantidad,precio) VALUES(?,?) WHERE Id_Juego = ?');
        $query->execute([$cantidad,$precio,$idJuego]);

        $id = $this->db->lastInsertId();

        return $id;
    }

    public function updatePedido($id,$cantidad,$precio){
        
    }
}