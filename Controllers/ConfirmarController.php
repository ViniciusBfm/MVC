<?php 
namespace Controllers;

use Models\Database;

class ConfirmarController {
    public function confirmarimpressao() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifica se a ação é de aprovação
            if (isset($_POST['id'], $_POST['acao']) && $_POST['acao'] === 'aprovar' && isset($_POST['status'])) {
                $id = $_POST['id'];
                $novoStatus = $_POST['status'];
                date_default_timezone_set('America/Sao_Paulo');
                $data_impresso =  date("Y-m-d H:i:s");
        
                try {
                    $pdo = Database::connect();
        
                    // Prepara a consulta para atualizar o status da solicitação
                    $stmt = $pdo->prepare("UPDATE solicitacao SET status = ?, data_impresso = ? WHERE id = ?");
                    $stmt->execute([$novoStatus, $data_impresso, $id]);
        
                    // Define uma mensagem de sucesso
                    $_SESSION['mensagem_status'] = "Solicitação N° $id marcada como impressa com sucesso.";
                } catch (\PDOException $e) {
                    // Define uma mensagem de erro
                    $_SESSION['mensagem_erro'] = "Erro ao alterar o status: " . $e->getMessage();
                }
            } else {
                $_SESSION['mensagem_recusar'] = "Dados inválidos.";
            }
        
            // Redireciona para a página de solicitações
            header("Location: " . INCLUDE_PATH . "painelreprografia");
            exit();
        }
    }        
}
?>