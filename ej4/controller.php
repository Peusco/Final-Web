<?php

require_once "model.php"
require_once "view.php"

class controllerAPI {
    private $model;
    private $view;


    public function __construct() {
        $this->model = new model();
        $this->view = new apiView();
    }

    public function get($params = null) {
        $get = $this->model->get();
        $this->view->response($get, 200);
    }


    function getCardsC($params = null) {
        $id = $params[':ID'];
        $cards = $this->model->getCards($id);
        if ($cards) {
            $this->view->response($cards, 200);
        } else {
            $this->view->response("No hay ninguna tarjeta asociada", 404);
        }
    }

    function getActivitiesE($params = null) {
        $id = $params[':ID'];
        $activities = $this->model->getActivities($id);
        if ($activities) {
            for ($i=0; $i < $activities-2 ; $i++) { 
                    $this->view->response($cards[$i], 200);    
            }
        } else {
            $this->view->response("No hay ninguna tarjeta asociada", 404);
        }
    }

    function deleteCardF($params = null){
        $idCard = $params[":ID"];
        $card = $this->model->getCard($idCard);
        if($card){
            $this->model->deleteCard($idCard);
            return $this->view->response("la tarjeta se borro", 200);
        }else{
            return $this->view->response("la tarjeta no existe", 404);
        }
    }
}