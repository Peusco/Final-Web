<?php

class model{
        private $DB;
    
        function __construct(){
            $this->DB = new PDO('mysql:host=localhost;'.'dbname= ;charset=utf8', 'root', '');
        }
          
        function checkKMS($id){
            $sentencia = $this->DB->prepare( 'SELECT FROM actividad WHERE id_client' );
            $sentencia->execute($id);
            $actividades = $sentencia->fetchAll(PDO::FETCH_OBJ);
            return $actividades;
        }

        function buscarCliente($dni){
            $sentencia = $this->DB->prepare( 'SELECT FROM cliente WHERE dni = ?');
            $sentencia->execute($dni);
            $client = $sentencia->fetch(PDO::FETCH_OBJ);
            return $client;
        }

        function añadirSaldo($kms, $fecha, $tipo_operacion, $idCliente){
            $sentencia = $this->DB->prepare("INSERT INTO actividad(kms,fecha,tipo_operacion) VALUES(?, ?, ?) where id_cliente = ?");
            $sentencia->execute(array($kms, $fecha, $tipo_operacion, $idCliente));
        }
    }