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


    function transferenciaRapida(){
        $this->helper->checkLoggedIn();
        if(isset($_POST['clientDni'], $_POST['montoAtransferir'])){
            $clientDni = $_POST['clientDni'];
            $montoAtransferir= $_POST['montoAtransferir'];
            $actividades = $this->model->checkKMS($_SESSION['id']);//el session tiene adentro la id del usuario que esta logueado es decir del que va a hacer la transferencia y esta se crea al loguearse
            if($actividades){
                foreach ($actividades as $actividad) {
                    if($actividad->tipo_operacion == 1){
                        $totalActividades -= $activdad->kms
                    }else{
                        $totalActividades += $activdad->kms
                    }
                }
            }else{
                $this->view->home("el usuario no tiene actividades")
            }
            $saldoTotal = $totalActividades - $montoAtransferir;
            if($saldoTotal >= 0){
                $cliente =$this->model->buscarCliente($clientDni);
                if($cliente){
                    $this->model->añadirSaldo($montoAtransferir, date('y-m-d'), 2 , $cliente->id);
                }else{
                    $this->view->home("el cliente al que desea hacerle la transferencia no existe")
                }
            }else{
                $this->view->home("ustedes no tiene el saldo suficiente para hacer esta tranferencia")
            }
        }else{
            $this->view->home("ingrese el monto y a quien le desea hacer la tranferencia")
        }

        }

}