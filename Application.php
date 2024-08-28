<?php 
define('INCLUDE_PATH','http://localhost/MVC/');
define('INCLUDE_PATH_FULL','http://localhost/MVC/Views/pages/');
define('INCLUDE_IMAGES','http://localhost/MVC/Views/pages/image');

    class Application
    {
        public function executar(){
            $url = isset($_GET['url']) ? explode('/',$_GET['url'])[0] : 'Home';
            
            $url = ucfirst($url); //Converte para maiusculo

            $url.="Controller";
            if(file_exists('Controllers/'.$url.'.php')){
                $className = 'Controllers\\'.$url;
                $controler = new $className;
                $controler->executar();
            }else{
                die("Essa pagina não existe");
            }
        }
    }
?>