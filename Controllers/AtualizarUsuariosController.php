<?php namespace Controllers;

use Models\Database;

class AtualizarUsuariosController
{
    public function executar()
    {
        // Verifica se o método é POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $matricula = $_POST['matricula'] ?? '';
            $funcao = $_POST['funcao'] ?? '';
            $senha = $_POST['senha'] ?? '';

            // Verifica se todos os campos obrigatórios foram preenchidos
            if (!empty($id) && !empty($nome) && !empty($email) && !empty($matricula) && !empty($funcao)) {
                // Conecta ao banco de dados
                $pdo = Database::connect();

                // Verifica se uma nova senha foi fornecida
                if (!empty($senha)) {
                    $hashedPassword = password_hash($senha, PASSWORD_BCRYPT);
                } else {
                    // Se não foi fornecida nova senha, mantém a senha existente
                    $stmt = $pdo->prepare("SELECT senha FROM usuarios WHERE id = ?");
                    $stmt->execute([$id]);
                    $usuario = $stmt->fetch();
                    $hashedPassword = $usuario['senha'];
                }

                // Atualiza os dados do usuário no banco de dados
                $stmt = $pdo->prepare("
                    UPDATE usuarios 
                    SET nome = ?, email = ?, matricula = ?, funcao = ?, senha = ? 
                    WHERE id = ?
                ");
                if ($stmt->execute([$nome, $email, $matricula, $funcao, $hashedPassword, $id])) {
                    // Redireciona para a página de sucesso ou painel
                    header('Location: ' . INCLUDE_PATH . 'paineladmin');
                    exit();
                } else {
                    echo "Erro ao atualizar o usuário.";
                }
            } else {
                echo "Preencha todos os campos obrigatórios.";
            }
        } else {
            echo "Método de requisição inválido.";
        }
    }
}
?>