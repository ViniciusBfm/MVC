<?php 
namespace Controllers;

use Models\Database;

class PaineladminController {

    private $pdo;

    const FUNCOES = ['Professor','Coordenação', 'Direção'];

    public function __construct() {
        // Conecta ao banco de dados
        $this->pdo = Database::connect();
        $this->view = new \Views\MainView('paineladmin');
    }

    public function executar() {
         // Inicia a sessão, caso ainda não esteja iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Verifica se o usuário está logado e se a função é 'admin'
        if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_funcao'] !== 'Administrador') {
            // Redireciona para a página de login ou acesso negado se não for admin
            header('Location: ' . INCLUDE_PATH . 'acessonegado');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifica se o formulário enviou uma ação
            $action = $_POST['action'] ?? '';
    
            if ($action === 'excluir') {
                // Se a ação for excluir, chama o método de exclusão
                $this->excluirUsuario();
                return; // Finaliza o método após excluir o usuário
            }
            
            // Obtém os dados do formulário para criar usuário
            $nome = $_POST['nome'] ?? '';
            $matricula = $_POST['matricula'] ?? '';
            $email = $_POST['email'] ?? '';
            $funcao = $_POST['funcao'] ?? '';
            $senha = $_POST['senha'] ?? '';
            
            // Verifica se o usuário está logado
            if (!isset($_SESSION['usuario_logado'])) {
                header('Location: ' . INCLUDE_PATH . 'login');
                exit();
            }
            
            // Validação básica
            if (!empty($nome) && !empty($matricula) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($funcao) && !empty($senha)) {
                try {
                    $pdo = Database::connect();
        
                    // Verifica se o email já está registrado
                    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
                    $stmt->execute([$email]);
        
                    if ($stmt->rowCount() > 0) {
                        $_SESSION['erro_criarconta'] = "Este email já está registrado.";
                    } else {
                        // Insere o novo usuário
                        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, matricula, email, funcao, senha) VALUES (?, ?, ?, ?, ?)");
                        if ($stmt->execute([$nome, $matricula, $email, $funcao, password_hash($senha, PASSWORD_DEFAULT)])) {
                            $_SESSION['sucesso_criarconta'] = "Conta criada com sucesso!";
                            header("Location: " . INCLUDE_PATH . "paineladmin");
                            exit();
                        } else {
                            $_SESSION['erro_criarconta'] = "Erro ao criar conta. Tente novamente.";
                        }
                    }
                } catch (Exception $e) {
                    $_SESSION['erro_criarconta'] = "Erro de conexão com o banco de dados: " . $e->getMessage();
                }
            } else {
                $_SESSION['erro_criarconta'] = "Por favor, preencha todos os campos corretamente.";
            }
        }
        
        // Obtém os usuários do banco de dados
        $usuarios = $this->getUsuarios();
        $totalUsuarios = $this->getTotalUsuarios();
        $totalAdmin = $this->getTotalUsuariosadmin();
        $totalcoord = $this-> getTotalUsuarioscoord();
        $totaldirecao = $this->getTotalUsuariosdirecao();
        $totalreprografia = $this->getTotalUsuariosreprografia();
        $totalPaginas = $this->getTotalPaginas();

        //Obtem informações das solicitações
        $Solicitacoesimpressasnumero = $this->solicitacoesimpressasnumero();
        $Solicitacoesaprovadasnumero = $this->solicitacoesaprovadasnumero();
        $solicitacoespendentesnumero = $this->solicitacoespendentesnumero();
        $Solicitacoesreprovadanumero = $this-> solicitacoesreprovadanumero();
    
        // Renderiza a view passando os dados dos usuários
        $this->view->render(array(
            "titulo" => "Painel admin",
            "usuarios" => $usuarios,
            "totalUsuarios" => $totalUsuarios,
            "totalAdmin" => $totalAdmin,
            "totalcoord"=>$totalcoord,
            "totaldirecao"=> $totaldirecao,
            "totalreprografia"=>$totalreprografia,
            "opcoes_funcao" => self::FUNCOES,
            "Solicitacoesimpressasnumero" => $Solicitacoesimpressasnumero,
            "Solicitacoesaprovadasnumero" => $Solicitacoesaprovadasnumero,
            "solicitacoespendentesnumero" => $solicitacoespendentesnumero,
            "Solicitacoesreprovadanumero" => $Solicitacoesreprovadanumero,
            "totalPaginas" => $totalPaginas
        ));
    }
    private function getUsuarios() {
        // Query para selecionar todos os usuários
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    private function getTotalUsuarios() {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT COUNT(*) AS total FROM usuarios");
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row['total'];
    }
    private function getTotalUsuariosadmin() {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT COUNT(*) AS total FROM usuarios WHERE funcao = 'Administrador'");
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row['total'];
    }
    private function getTotalUsuarioscoord() {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT COUNT(*) AS total FROM usuarios WHERE funcao = 'Coordenação'");
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row['total'];
    }
    private function getTotalUsuariosdirecao() {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT COUNT(*) AS total FROM usuarios WHERE funcao = 'Direção'");
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row['total'];
    }
    private function getTotalUsuariosreprografia() {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT COUNT(*) AS total FROM usuarios WHERE funcao = 'Reprografia'");
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row['total'];
    }

    public function excluirUsuario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtém o ID do usuário a ser excluído
            $id = $_POST['id'] ?? '';
    
            // Verifica se o ID é válido
            if (!empty($id) && is_numeric($id)) {
                try {
                    // Conecta ao banco de dados
                    $pdo = Database::connect();
                    
                    // Prepara a instrução SQL para excluir o usuário
                    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
                    
                    // Executa a exclusão
                    if ($stmt->execute([$id])) {
                        $_SESSION['sucesso_excluirusuario'] = "Usuário excluído com sucesso!";
                    } else {
                        $_SESSION['erro_excluirusuario'] = "Erro ao excluir o usuário.";
                    }
                } catch (Exception $e) {
                    $_SESSION['erro_excluirusuario'] = "Erro de conexão com o banco de dados: " . $e->getMessage();
                }
            } else {
                $_SESSION['erro_excluirusuario'] = "ID inválido.";
            }
    
            // Redireciona de volta para a página do painel admin
            header("Location: " . INCLUDE_PATH . "paineladmin");
            exit();
        }
    }

    public function solicitacoesimpressasnumero() {
        
        // Query para contar as solicitações aprovadas do usuário logado
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM solicitacao WHERE status = 'Impresso'");
        $stmt->execute();

        // Obtém o resultado e retorna o total de solicitações aprovadas
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row['total'];
    }
    public function solicitacoesaprovadasnumero() {
        
        // Query para contar as solicitações aprovadas do usuário logado
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM solicitacao WHERE status = 'aprovado'");
        $stmt->execute();

        // Obtém o resultado e retorna o total de solicitações aprovadas
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row['total'];
    }
    public function solicitacoespendentesnumero() {
        
        // Query para contar as solicitações aprovadas do usuário logado
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM solicitacao WHERE status = 'pendente'");
        $stmt->execute();

        // Obtém o resultado e retorna o total de solicitações aprovadas
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row['total'];
    }
    public function Solicitacoesreprovadanumero() {
        
        // Query para contar as solicitações aprovadas do usuário logado
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM solicitacao WHERE status = 'reprovado'");
        $stmt->execute();

        // Obtém o resultado e retorna o total de solicitações aprovadas
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row['total'];
    }
    private function getTotalPaginas() {
        // Consulta para somar o total de páginas
        $stmt = $this->pdo->prepare("SELECT SUM(total_solicitacao) as total_paginas FROM solicitacao");
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        // Retorna o valor da soma, ou 0 caso não exista
        return $result['total_paginas'] ?? 0;
    }
    
}
?>