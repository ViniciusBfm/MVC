<?php 
    namespace Controllers;

    class EsqueceuasenhaController{
        
        public function __construct(){
            $this->view = new \Views\MainView('esqueceuasenha', null, null);
        }
        public function executar(){
            $this->view->render(array("titulo"=>"esqueceuasenha"));
            
        }
    }
?>