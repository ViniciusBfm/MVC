<?php
namespace Controllers;

use Models\Database;

class ReeenviarSolicitacaoController extends Controller
{
    public function __construct() {
        // Nenhum header ou footer específico para este controlador
    }

    public function executar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Inicia a sessão, se não estiver iniciada
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Verifica se o usuário está logado
            if (!isset($_SESSION['usuario_logado'])) {
                header('Location: ' . INCLUDE_PATH . 'login');
                exit();
            }

            if (isset($_POST['action']) && $_POST['action'] === 'reenviar' && isset($_POST['id'])) {
                $id = $_POST['id'] ?? '';
                try {
                    // Conecta ao banco de dados
                    $pdo = Database::connect();
                    
                    // Prepara a instrução SQL para alterar para pendente a solicitação
                    $stmt = $pdo->prepare("UPDATE solicitacao SET status = 'pendente', observacao = '' WHERE id = ?");
                    $stmt->execute([$id]);
         
                    $_SESSION['sucesso_excluirsolicitacao'] = "Solicitação N° $id atualizada com sucesso!";

                } catch (\PDOException $e) {
                    $_SESSION['erro_excluirsolicitacao'] = "Erro de conexão com o banco de dados: " . $e->getMessage();
                }
            } else {
                $_SESSION['erro_excluirsolicitacao'] = "ID inválido.";
            }

            // Redireciona para a página de solicitações
            header('Location: ' . INCLUDE_PATH . 'solicitacao');
            exit();
        }
    }
}
?>