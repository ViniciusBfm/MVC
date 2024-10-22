<?php
// Inicia a sessão para o gerenciamento do estado do usuário
session_start();

define('INCLUDE_PATH','http://localhost/Reprografia/');
define('INCLUDE_PATH_FULL','http://localhost/Reprografia/Views/pages/');
define('INCLUDE_IMAGES','http://localhost/Reprografia/Views/pages/image');
define('INCLUDE_LOGOUT','http://localhost/Reprografia/Controllers/LogoutController.php');

class Application
{
    public function executar()
    {
        // URLs que não requerem autenticação
        $publicPages = ['login', 'criarconta', 'esqueceuasenha'];

        // Obtém a URL atual
        $url = isset($_GET['url']) ? explode('/', $_GET['url'])[0] : 'login';

        // Verifica se a página não está na lista de páginas públicas e o usuário não está logado
        if (!isset($_SESSION['usuario_logado']) && !in_array(strtolower($url), $publicPages)) {
            // Redireciona para a página de login
            header('Location: ' . INCLUDE_PATH . 'login');
            exit();
        }

        // Verifica se a URL é "atualizarusuario" e o método é POST
        if ($url === 'atualizarusuario' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new Controllers\AtualizarUsuariosController();
            $controller->executar();
            return; // Para garantir que a execução pare aqui
        }

        // Verificar para baixar os arquivos
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'baixarsolicitacao') {
            $downloadController = new Controllers\DownloadController();
            $downloadController->baixarSolicitacao(); // Chamando o método de download
            return; // Garante que a execução pare aqui após o download
        }

        // Verifica se a URL é "alterarstatus" e o método é POST
        if ($url === 'alterarstatus' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new Controllers\SolicitationController();
            $controller->alterarStatus(); // Chama o método de alterar status
            return; // Para garantir que a execução pare aqui
        }

        if ($url === 'confirmarimpressao' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new Controllers\ConfirmarController();
            $controller->confirmarimpressao(); // Chama o método
            return; // Para garantir que a execução pare aqui
        }
        // Exemplo básico de roteamento
        if ($url === 'confirmarimpressao/relatar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new Controllers\ConfirmarController();
            $controller->confirmarimpressao(); // Chama o método 
            return; // Para garantir que a execução pare aqui
        }
        if ($url === 'deletarsolicitacao' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new Controllers\DeletarNotificacaoController();
            $controller->executar(); // Chama o método 
            return; // Para garantir que a execução pare aqui
        }
        if ($url === 'reenviarsolicitacao' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new Controllers\ReeenviarSolicitacaoController();
            $controller->executar(); // Chama o método 
            return; // Para garantir que a execução pare aqui
        }


        
        // Normaliza a URL para carregar o controlador correspondente
        $url = ucfirst($url);
        $url .= "Controller";

        if (file_exists('Controllers/' . $url . '.php')) {
            $className = 'Controllers\\' . $url;
            $controller = new $className;
            $controller->executar();
        } else {
            die("Essa página não existe");
        }
    }
}
?>