<?php 
namespace Controllers;

use Models\Database;

class CriarcontaController extends Controller {

    const FUNCOES = ['Professor','Coordenação', 'Direção'];

    public function __construct() {
        $this->view = new \Views\MainView('criarconta', null, null);
    }

    public function executar() {
            // Obtém os dados do formulário
            $nome = $_POST['nome'] ?? '';
            $matricula = $_POST['matricula'] ?? '';
            $email = $_POST['email'] ?? '';
            $funcao = $_POST['funcao'] ?? '';
            $senha = $_POST['senha'] ?? '';
    
        // Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Valida os dados (você pode adicionar mais validações aqui)
            if (!empty($nome) && !empty($matricula) && !empty($email) && !empty($funcao) && !empty($senha)) {
                
                // Validação da senha                
                if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z]).{6,}$/', $senha)) {
                    $_SESSION['erro_criarconta'] = "A senha deve ter pelo menos 6 caracteres, incluindo uma letra maiúscula e uma letra minúscula.";
                    header("Location: " . INCLUDE_PATH . "criarconta"); // Redirecione para a página de criação de conta
                    exit();
                }

        
                // Conecta ao banco de dados
                $pdo = Database::connect();
        
                // Verifica se o email já está registrado
                $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
                $stmt->execute([$email]);
                
                if ($stmt->rowCount() > 0) {
                    // Email já registrado
                    $_SESSION['erro_criarconta'] = "Este email já está registrado.";
                } else {
                    // Insere o novo usuário no banco de dados
                    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, matricula, email, funcao, senha) VALUES (?, ?, ?, ?, ?)");
        
                    // Insere os dados
                    if ($stmt->execute([$nome, $matricula, $email, $funcao, password_hash($senha, PASSWORD_DEFAULT)])) {
                        // Redireciona para a página de login com mensagem de sucesso
                        $_SESSION['sucesso_criarconta'] = "Conta criada com sucesso!";
                        header("Location: " . INCLUDE_PATH . "login");
                        exit();
                    } else {
                        $_SESSION['erro_criarconta'] = "Erro ao criar conta. Tente novamente.";
                    }
                }
            } else {
                // Dados inválidos
                $_SESSION['erro_criarconta'] = "Por favor, preencha todos os campos.";
            }
        }
        

        // Passa as funções e possíveis mensagens de erro para a view
        $erro_criarconta = $_SESSION['erro_criarconta'] ?? null;
        unset($_SESSION['erro_criarconta']); // Limpa a mensagem após exibição
        
        // Renderiza a view, passando as variáveis
        $this->view->render(array(
            "titulo" => "criarconta",
            "opcoes_funcao" => self::FUNCOES,
            "erro_criarconta" => $erro_criarconta,
            "nome" => $nome,
            "matricula" => $matricula,
            "email" => $email,
            "funcao" => $funcao,
            "senha" => $senha
        ));
    }
    

}
?>