<?php 
    namespace Controllers;
    use Models\Database;

    class PainelsolicitacoesController{

        private $pdo;
        
        public function __construct(){
            $this->pdo = Database::connect();
            $this->view = new \Views\MainView('painelsolicitacoes');
        }
        public function executar(){

              // Inicia a sessão, caso ainda não esteja iniciada
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Verifica se o usuário está logado e se a função é 'Administrador' ou 'Reprografia'
            if (!isset($_SESSION['usuario_logado']) || 
                ($_SESSION['usuario_funcao'] !== 'Administrador' && $_SESSION['usuario_funcao'] !== 'Direção' && $_SESSION['usuario_funcao'] !== 'Coordenação') ) {
                // Redireciona para a página de acesso negado se não for 'Administrador' nem 'Reprografia'
                header('Location: ' . INCLUDE_PATH . 'acessonegado');
                exit();
            }

            $Solicitacoespendentes = $this->getSolicitacoespendentes();
            $Solicitacoesimpressas = $this->getSolicitacoesimpressas();
            
            $this->view->render(array(             
                "titulo" => "Painel solicitacoes",
                "solicitacoespendentes" => $Solicitacoespendentes,
                "solicitacoesimpressas" => $Solicitacoesimpressas
            ));     
        }
        private function getSolicitacoespendentes() {
            // Query para selecionar todas as solicitações
            $stmt = $this->pdo->prepare("SELECT * FROM solicitacao WHERE status = 'Pendente'");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        private function getSolicitacoesimpressas() {
            // Query para selecionar todas as solicitações
            $stmt = $this->pdo->prepare("SELECT * FROM solicitacao WHERE status = 'Impresso'");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
    }
?>