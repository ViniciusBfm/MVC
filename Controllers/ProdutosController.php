<?php 
    namespace Controllers;

    class ProdutosController{
        
        public function __construct(){
            $this->view = new \Views\MainView('produtos');
        }
        public function executar(){
            $this->view->render(array("titulo"=>"Produtos"));
            
        }
    }
?>