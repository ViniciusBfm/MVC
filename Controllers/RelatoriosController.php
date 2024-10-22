<?php 
    namespace Controllers;

    class RelatoriosController{
        
        public function __construct(){
            $this->view = new \Views\MainView('relatorios');
        }
        public function executar(){
            $this->view->render(array(
                "titulo" => "relatorios"
            ));
            
        }
    }
?>