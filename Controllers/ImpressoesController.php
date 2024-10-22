<?php 
    namespace Controllers;
    use Models\Database;

    class ImpressoesController{

        private $pdo;
        
        public function __construct(){
            $this->pdo = Database::connect();
            $this->view = new \Views\MainView('impressoes');
        }
        
        public function executar(){
            
            $todassolicitacoes = $this->getSolicitacoestodas();
            $totalPaginas = $this->getTotalPaginas();
            
            $this->view->render(array(
                "titulo" => "impressoes",
                "todassolicitacoes" => $todassolicitacoes,
                "totalPaginas" => $totalPaginas
            ));
            
            
        }
        private function getSolicitacoestodas() {
            // Query para selecionar todas as solicitações
            $stmt = $this->pdo->prepare("SELECT * FROM solicitacao  WHERE status = 'Impresso'");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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