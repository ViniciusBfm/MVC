<?php namespace Controllers;

use Models\Database;

class RelatarproblemaController
{
    public function executar()
    {
    // Verifica se o formulário foi enviado e se os campos 'observacao' e 'solicitacao_id' estão presentes
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['observacao'], $_POST['solicitacao_id'])) {

        // Obtenha os valores do campo 'observacao' e 'solicitacao_id'
        $observacao = $_POST['observacao'] ?? '';
        $solicitacao_id = $_POST['solicitacao_id'] ?? ''; // Verifique se o nome está correto aqui
        date_default_timezone_set('America/Sao_Paulo');
        $data_impresso =  date("Y-m-d H:i:s");

        try {
            $pdo = Database::connect();

            // Prepara a consulta para atualizar a observação e o status da solicitação
            $stmt = $pdo->prepare("UPDATE solicitacao SET observacao = ?, status = 'reprovado', data_impresso = ? WHERE id = ?");
            $stmt->execute([$observacao, $data_impresso, $solicitacao_id]);

            // Mensagem de sucesso
            $_SESSION['mensagem_status'] = "Solicitação N° $solicitacao_id foi reprovada com sucesso.";
        } catch (\PDOException $e) {
            // Define uma mensagem de erro
            $_SESSION['mensagem_recusar'] = "Erro ao alterar a observação: " . $e->getMessage() . " (ID: $solicitacao_id, Observação: $observacao)";
        }
        // Redireciona para a página de solicitações
        header("Location: " . INCLUDE_PATH . "painelreprografia");
        exit();
    } else {
        // Adiciona o ID e a observação à mensagem de erro
        $observacao = $_POST['observacao'] ?? '';
        $solicitacao_id = $_POST['solicitacao_id'] ?? '';
        $_SESSION['mensagem_recusar'] = "Dados inválidos. (ID: $solicitacao_id, Observação: $observacao)";
        header("Location: " . INCLUDE_PATH . "painelreprografia");
        exit();
    }

}

}