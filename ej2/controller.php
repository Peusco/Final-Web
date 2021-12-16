<?php

require_once "model.php";
require_once "view.php";

class controller{
    private $model;
    private $view; 

    function __construct(){
        $this->model = new model;
        $this->view = new view; 
    }


    function showClientData(){
        if(isset($_POST['nombre'])){
            $client = $this->model->searchClient($_POST['nombre']);
            if($client){
                $actividades = $this->model->actividades($client->id);//esta funcion deberia estar en otro model pero para ahorrar tiempo no lo hago
                if($actividades){
                    foreach ($actividades as $actividad) {
                        if($actividad->tipo_operacion == 1){
                            $totalActividades -= $activdad->kms
                        }else{
                            $totalActividades += $activdad->kms
                        }
                    }
                }else{
                    $totalActividades = "El cliente no tiene actividades"
                }
                $this->model->tarjetas($client->id);//esta funcion deberia estar en otro model pero para ahorrar tiempo no lo hago
                if($tarjetas){
                    $tarjetasCliente = $tarjetas
                }else{
                    $tarjetasCliente = "El cliente no tiene tarjetas asociadas"
                }

                $this->view->showClienteData($client->id, $client->dni, $totalActividades, $actividades, $tarjetasCliente);
            }else{
                $this->view->home("El cliente no existe")
            }
        }else{
            $this->view->home("Ingrese el nombre que desea buscar")
        }
    }
}