<?php 
    namespace Controllers;

    class LoginController extends Controller{

        public function __construct(){
            $this->view = new \Views\MainView('login', null,null);
        }

        public function executar(){
            $this->view->render(array("titulo"=>"login"));
        }
    }
?>