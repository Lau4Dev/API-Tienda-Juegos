<?php

class JuegoApiModel{
    private $db;

    public  function __construct(){
        $this->db = new PDO('mysql:host=localhost; dbname=tiendajuegos; charset=utf8', 'root', '');
    }

    public function getJuegos(){
        $query = $this->db->prepare('SELECT * FROM juego');
        $query->execute();

        $juegos = $query->fetchAll(PDO::FETCH_OBJ);

        return $juegos;
    }

    public function getJuegoById($id){
        $query = $this->db->prepare('SELECT * FROM juego WHERE Id_Juego = ?');
        $query->execute([$id]);

        $juego = $query->fetch(PDO::FETCH_OBJ);

        return $juego;
    }

    public function deleteJuego($id){
        $query = $this->db->prepare('DELETE FROM juego WHERE Id_Juego = ?');
        $query->execute([$id]);
    }

    public function insertJuego($nombre, $generos, $calificacion){
        $query = $this->db->prepare('INSERT INTO juego(nombre_juego,generos,califiacion) VALUES (?,?,?)');
        $query->execute([$nombre, $generos, $calificacion]);

        $id = $this->db->lastInsertId();
    
        return $id;
    }

    public function updateJuego($id,$nombre,$generos,$calificacion){
        $query = $this->db->prepare('UPDATE juego SET nombre_juego = ?, generos = ?, califiacion = ? WHERE Id_Juego = ?');
        $query->execute([$nombre, $generos, $calificacion, $id]);
    }

}