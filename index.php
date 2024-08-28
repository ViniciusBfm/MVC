<?php 
    $autoload = function($class) {
        if($class == '\Mail'){
            include('phpmailer/PHPMailerAutoload.php');
        }
        include($class.'.php');
    };
    
    spl_autoload_register($autoload);
    
    $app = new Application();
    $app->executar();
    
?>