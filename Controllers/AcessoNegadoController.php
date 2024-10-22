<?php 
    namespace Controllers;

    class AcessoNegadoController{
        
        public function __construct(){
            $this->view = new \Views\MainView('acessonegado');
        }
        public function executar(){
            $this->view->render(array(
                "titulo" => "acesso negado"
            ));
            
        }
    }
?>