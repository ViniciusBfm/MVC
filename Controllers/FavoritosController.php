<?php 
    namespace Controllers;

    class FavoritosController{
        
        public function __construct(){
            $this->view = new \Views\MainView('favoritos');
        }
        public function executar(){
            $this->view->render(array("titulo"=>"Favoritos"));
            
        }
    }
?>