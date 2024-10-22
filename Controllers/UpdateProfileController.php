<?php
namespace Controllers;

use Models\Database;

class UpdateProfileController extends Controller
{
    public function __construct() {
        // Nenhum header ou footer específico para este controlador
    }

    public function executar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            // Verifica se o usuário está logado
            if (!isset($_SESSION['usuario_logado'])) {
                header('Location: ' . INCLUDE_PATH . 'login');
                exit();
            }

            if (!empty($nome) && !empty($email)) {
                // Conecta ao banco de dados
                $pdo = Database::connect();

                // Se a senha foi fornecida, faz o hash e atualiza o banco
                if (!empty($senha)) {
                    $hashedPassword = password_hash($senha, PASSWORD_BCRYPT);
                } else {
                    // Se a senha não foi fornecida, mantenha a senha existente
                    $hashedPassword = $_SESSION['usuario_senha'];
                }

                // Prepara a query para atualizar as informações
                $stmt = $pdo->prepare("
                    UPDATE usuarios 
                    SET nome = ?, senha = ?, email = ?
                    WHERE email = ?
                ");

                // Executa a query
                if ($stmt->execute([$nome, $hashedPassword, $email, $_SESSION['usuario_email']])) {
                    // Atualiza as informações da sessão
                    $_SESSION['usuario_nome'] = $nome;
                    $_SESSION['usuario_email'] = $email;
                    $_SESSION['usuario_senha'] = $hashedPassword; // Atualiza a senha hash na sessão

                    // Redireciona para a página inicial após a atualização
                    header('Location: ' . INCLUDE_PATH . 'solicitacao');
                    exit();
                } else {
                    // Em caso de erro, você pode redirecionar para a mesma página com uma mensagem de erro
                    $_SESSION['error_message'] = 'Erro ao atualizar perfil.';
                    header('Location: ' . INCLUDE_PATH . 'solicitacao');
                    exit();
                }
            } else {
                // Em caso de dados incompletos
                $_SESSION['error_message'] = 'Altere seus dados';
                header('Location: ' . INCLUDE_PATH . 'solicitacao');
                exit();
            }
        } else {
            // Redireciona para a página inicial se o método não for POST
            header('Location: ' . INCLUDE_PATH . 'solicitacao');
            exit();
        }
    }
}
?>