<?php

class model{
        private $DB;
    
        function __construct(){
            $this->DB = new PDO('mysql:host=localhost;'.'dbname= ;charset=utf8', 'root', '');
        }
        
        function searchClient($nombre){
            $sentencia = $this->DB->prepare( 'SELECT FROM cliente WHERE nombre = ?');
            $sentencia->execute($nombre);
            $client = $sentencia->fetch(PDO::FETCH_OBJ);
            return $client;
        }

        function actividades($dni){
            $sentencia = $this->DB->prepare( 'SELECT * FROM actividad WHERE id_cliente = ?');
            $sentencia->execute($dni);
            $actividades = $sentencia->fetchAll(PDO::FETCH_OBJ);
            return $actividades;
        }

        function tarjetas($dni){
            $sentencia = $this->DB->prepare( 'SELECT * FROM tarjeta WHERE id_cliente = ?');
            $sentencia->execute($dni);
            $tarjetas = $sentencia->fetchAll(PDO::FETCH_OBJ);
            return $tarjetas;
        }
    }