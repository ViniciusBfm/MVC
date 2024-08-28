<?php 
    namespace Controllers;

    class CarrinhoController{
        
        public function __construct(){
            $this->view = new \Views\MainView('carrinho');
        }
        public function executar(){
            $this->view->render(array("titulo"=>"Carrinho"));
            
        }
    }
?>