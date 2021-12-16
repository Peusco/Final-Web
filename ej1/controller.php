<?php

require_once "model.php";
require_once "view.php";
require_once "helper.php";

class controller{
    private $model;
    private $view;
    private $helper;

    function __construct(){
        $this->model = new model;
        $this->view = new view;
        $this->helper = new helper;
    }

    function addClient(){
        if(isset($_POST['nombre'], $_POST['dni'], $_POST['telefono'] ,$_POST['direccion'], $_POST['ejecutivo'])){
            $nombre = $_POST['nombre'];
            $dni = $_POST['dni'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
            $ejecutivo = $_POST['ejecutivo'];
            $this->helper->checkAdmin() //se fija si el usuario es admin
            $clientDni = $this->model->checkDni($dni);
            if(empty($clientDni){
                $this->model->insertClient($nombre,$dni,$telefono,$direccion,$ejecutivo);
                if(isset($_POST['fecha_alta'], $_POST['nro_tarjeta'], $_POST['fecha_vencimiento'])){
                    $fecha_alta = $_POST['fecha_alta'];
                    $nro_tarjeta= $_POST['nro_tarjeta'];
                    $fecha_vencimiento= $_POST['fecha_vencimiento'];

                    if($ejecutivo == true){
                        $this->model->addCard($fecha_alta, $nro_tarjeta, $fecha_vencimiento, "Ejecutiva" )//esta funcion deberia estar en otro model pero para ahorrar tiempo no lo hago
                        $currentClient = $this->model->checkDni($dni);
                        $this->model->addActividad(200, date('y-m-d'), 2 , $currentClient->id)//esta funcion deberia estar en otro model pero para ahorrar tiempo no lo hago
                        $this->view->home("Cliente creado");
                    }else{
                        $this->model->addCard($fecha_alta, $nro_tarjeta, $fecha_vencimiento, "Normal" )//esta funcion deberia estar en otro model pero para ahorrar tiempo no lo hago
                        $currentClient = $this->model->checkDni($dni);
                        $this->model->addActividad(200, date('y-m-d'), 2 , $currentClient->id)//esta funcion deberia estar en otro model pero para ahorrar tiempo no lo hago
                        $this->view->home("Cliente creado");
                    }
                }else{
                    $this->view->home("Llene los campos con los datos de la tarjeta");
                }
            }else{
                $this->view->home("Ya existe un usuario con ese DNI");
            }
        }else{
            $this->view->home("Llene todos los campos");
        }
    }
}