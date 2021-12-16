<?php

class model{
        private $DB;
    
        function __construct(){
            $this->DB = new PDO('mysql:host=localhost;'.'dbname=YPF;charset=utf8', 'root', '');
        }
        
        function checkDni($dni){
            $sentencia = $this->DB->prepare( 'SELECT FROM cliente WHERE dni = ?');
            $sentencia->execute($dni);
            $clientDni = $sentencia->fetch(PDO::FETCH_OBJ);
            return $clientDni;
        }

        function insertClient($nombre,$dni,$telefono,$direccion,$ejecutivo){
            $sentencia = $this->DB->prepare("INSERT INTO cliente(nombre,dni, telefono, direccion, ejecutivo) VALUES(?, ?, ?, ?, ?)");
            $sentencia->execute(array($nombre,$dni,$telefono,$direccion,$ejecutivo ));
        }

        function addCard($fecha_alta, $nro_tarjeta, $fecha_vencimiento, $tipo_tarjeta){
            $sentencia = $this->DB->prepare("INSERT INTO tarjeta(fecha_alta,nro_tarjeta,fecha_vencimiento,tipo_tarjeta) VALUES(?, ?, ?, ?)");
            $sentencia->execute(array($fecha_alta, $nro_tarjeta, $fecha_vencimiento, $tipo_tarjeta ));
        }

        function addActividad($kms, $fecha, $tipo_operacion, $idCliente){
            $sentencia = $this->DB->prepare("INSERT INTO actividad(kms,fecha,tipo_operacion) VALUES(?, ?, ?) where id_cliente = ?");
            $sentencia->execute(array($kms, $fecha, $tipo_operacion, $idCliente));
        }
    }