<?php 
    namespace Controllers;
    use Models\Database;

    class PainelreprografiaController{

        private $pdo;
        
        public function __construct(){
            $this->pdo = Database::connect();
            $this->view = new \Views\MainView('painelreprografia');
        }
        public function executar(){
             // Inicia a sessão, caso ainda não esteja iniciada
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Verifica se o usuário está logado e se a função é 'Administrador' ou 'Reprografia'
            if (!isset($_SESSION['usuario_logado']) || 
                ($_SESSION['usuario_funcao'] !== 'Administrador' && $_SESSION['usuario_funcao'] !== 'Reprografia')) {
                // Redireciona para a página de acesso negado se não for 'Administrador' nem 'Reprografia'
                header('Location: ' . INCLUDE_PATH . 'acessonegado');
                exit();
            }


            $Solicitacoesaprovadas = $this->getSolicitacoesaprovadas();
            $Solicitacoesaprovadasnumero = $this->solicitacoesaprovadasnumero();
        
            $this->view->render(array(
                "titulo" => "Painel reprografia",
                "Solicitacoesaprovadas" => $Solicitacoesaprovadas,
                "Solicitacoesaprovadasnumero" => $Solicitacoesaprovadasnumero
            ));
            
        }
        private function getSolicitacoesaprovadas() {
            // Query para selecionar todas as solicitações
            $stmt = $this->pdo->prepare("SELECT * FROM solicitacao WHERE status = 'Aprovado'");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
    
        public function solicitacoesaprovadasnumero() {
            $stmt = $this->pdo->query("SELECT COUNT(*) AS total FROM solicitacao WHERE status = 'Aprovado'");
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $row['total'];  // Retorna o total de solicitações aprovadas
        }
                            
    }
?>