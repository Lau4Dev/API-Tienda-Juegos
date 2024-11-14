<?php

class JuegoApiModel{
    private $db;

    public  function __construct(){
        $this->db = new PDO('mysql:host=localhost; dbname=tiendajuegos; charset=utf8', 'root', '');
    }

    public function getJuegos($filtrarGenero = null, $orderBy = false, $order = null){
        $sql = 'SELECT * FROM juego';

        //preguntar
        if($filtrarGenero != null) {
            $sql .= " WHERE LOWEr(generos) LIKE LOWER (:genero) ";
        }

         $ORDERBY = ' ORDER BY nombre_juego';

        if($orderBy){
            switch($orderBy){
                case 'generos':
                    $ORDERBY = ' ORDER by generos';
                    break;
                case 'califiacion':
                    $ORDERBY = ' ORDER by califiacion';
                    break;
            }
            if($order === 'DESC'){
                $ORDERBY .=  ' DESC';
            }
            else{
                $ORDERBY .= ' ASC';
            }
        }
        
        $sql .= $ORDERBY;


        $query = $this->db->prepare($sql);
        if($filtrarGenero != null){
            $query->execute([':genero' => "%$filtrarGenero%"]);
        }else{
            $query->execute();
        }

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