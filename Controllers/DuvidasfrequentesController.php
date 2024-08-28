<?php 
    namespace Controllers;

    class DuvidasfrequentesController extends Controller{

        public function __construct(){
            $this->view = new \Views\MainView('duvidasfrequentes');
        }

        public function executar(){
            $this->view->render(array("titulo"=>"Duvidas frequentes"));
        }
    }
?>