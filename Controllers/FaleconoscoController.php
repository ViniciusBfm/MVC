<?php 
    namespace Controllers;

    class FaleconoscoController extends Controller{

        public function __construct(){
            $this->view = new \Views\MainView('faleconosco');
        }

        public function executar(){
            $this->view->render(array("titulo"=>"Fale conosco"));
        }
    }
?>