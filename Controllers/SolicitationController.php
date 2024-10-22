<?php 
namespace Controllers;

use Models\Database;

class SolicitationController {
    public function alterarStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['status'] === 'reprovado' && isset($_POST['id']) && isset($_POST['status'])) {
                $id = $_POST['id'];
                $novoStatus = $_POST['status'];
                $usuario = $_SESSION['usuario_nome'];
                $observacao = 'Solicitacão reprovada por: '. $usuario;
                date_default_timezone_set('America/Sao_Paulo');
                $data_confirmacao =  date("Y-m-d H:i:s");

                try {
                    $pdo = Database::connect();

                    // Prepara a consulta para atualizar o status da solicitação
                    $stmt = $pdo->prepare("UPDATE solicitacao SET observacao = ?, status = 'reprovado', data_confirmacao = ? WHERE id = ?");
                    $stmt->execute([$observacao, $data_confirmacao, $id]);


                    // Define uma mensagem de sucesso
                    $_SESSION['mensagem_status'] = "Solicitação N° $id $novoStatus com sucesso.";
                } catch (\PDOException $e) {
                    // Define uma mensagem de erro
                    $_SESSION['mensagem_recusar'] = "Erro ao alterar a observação: " . $e->getMessage();
                }
            }
            elseif (isset($_POST['id']) && isset($_POST['status'])){
                $id = $_POST['id'];
                $novoStatus = $_POST['status'];
                date_default_timezone_set('America/Sao_Paulo');
                $data_confirmacao =  date("Y-m-d H:i:s");

                try {
                    $pdo = Database::connect();
        
                    // Prepara a consulta para atualizar o status da solicitação
                    $stmt = $pdo->prepare("UPDATE solicitacao SET status = ?, data_confirmacao = ? WHERE id = ? ");
                    $stmt->execute([$novoStatus, $data_confirmacao, $id]);
        
                    // Define uma mensagem de sucesso
                    $_SESSION['mensagem_status'] = "Solicitação N° $id marcada como $novoStatus com sucesso.";
                } catch (\PDOException $e) {
                    // Define uma mensagem de erro
                    $_SESSION['mensagem_erro'] = "Erro ao alterar o status: " . $e->getMessage();
                }
            }else {
                $_SESSION['mensagem_recusar'] = "Dados inválidos.";
            }
            // Redireciona para a página de solicitações
            header("Location: " . INCLUDE_PATH . "painelsolicitacoes");
            exit();

        }
    }
}

?>