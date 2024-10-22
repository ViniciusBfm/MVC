<?php 
namespace Controllers;

use Models\Database;

class LoginController extends Controller {

    public function __construct() {
        $this->view = new \Views\MainView('login', null, null);
    }

    public function executar() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            if ($this->validarCredenciais($email, $senha)) {
                // Redireciona para a página inicial após o login bem-sucedido
                header("Location: ".INCLUDE_PATH."solicitacao");
                exit();
            } else {
                // Armazena a mensagem de erro na sessão
                $_SESSION['erro_login'] = "Usuário ou senha incorretos.";
                header("Location: ".INCLUDE_PATH."login");
                exit();
            }
        }

        // Mostra a página de login e a mensagem de erro, se houver
        $erro_login = $_SESSION['erro_login'] ?? null;
        unset($_SESSION['erro_login']); // Limpa a mensagem de erro após exibição
        $this->view->render(array("titulo" => "login", "erro_login" => $erro_login));
    }

    private function validarCredenciais($email, $senha) {
        // Conecta ao banco de dados
        $pdo = Database::connect();
    
        // Preparando a consulta para buscar o usuário pelo email
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
    
        // Verifica se o usuário foi encontrado
        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);
    
            // Verifica a senha usando password_verify
            if (password_verify($senha, $usuario['senha'])) {
                // Armazena o nome e a matrícula do usuário na sessão
                $_SESSION['usuario_logado'] = true;
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_matricula'] = $usuario['matricula'];
                $_SESSION['usuario_email'] = $usuario['email'];
                $_SESSION['usuario_senha'] = $usuario['senha'];
                $_SESSION['usuario_funcao'] = $usuario['funcao'];
                $_SESSION['usuario_id'] = $usuario['id'];
                return true;
            }
        }
    
        return false;
    }
}
?>