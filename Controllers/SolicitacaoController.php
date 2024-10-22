<?php 
namespace Controllers;
use Models\Database;

class SolicitacaoController{

    private $pdo;

    const SETOR = ['Toddler','Nursery', 'Sk','JK','Year 1','Year 2','Year 3','Year 4','Administrativo'];
    const COR = ['Colorido','Preto e Branco'];
    
    public function __construct(){
        $this->pdo = Database::connect();
        $this->view = new \Views\MainView('solicitacao');
    }
    public function executar() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtém os dados do formulário
            $numero_paginas = $_POST['numero_paginas'] ?? '';
            $numero_copias = $_POST['numero_copias'] ?? '';
            $setor = $_POST['setor'] ?? '';
            $corcopia = $_POST['corcopia'] ?? '';
            $dia_entrega = $_POST['dia_entrega'] ?? '';
            $usuario = $_SESSION['usuario_nome'];
            $id_usuario =  $_SESSION['usuario_id'];
            $funcao_usuario =  $_SESSION['usuario_funcao'];
            date_default_timezone_set('America/Sao_Paulo');
            $data_solicitacao = date("Y-m-d H:i:s");
            $total_solicitacao = $numero_paginas * $numero_copias; // Total de páginas solicitado
        
            if (!isset($_SESSION['usuario_logado'])) {
                header('Location: ' . INCLUDE_PATH . 'login');
                exit();
            }
        
            // Verificar se o arquivo foi enviado corretamente
            if (isset($_FILES['arquivo_impressao']) && $_FILES['arquivo_impressao']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['arquivo_impressao']['tmp_name'];
                $fileName = $_FILES['arquivo_impressao']['name'];
                $fileSize = $_FILES['arquivo_impressao']['size'];
                $fileType = $_FILES['arquivo_impressao']['type'];
        
                // Ler o conteúdo do arquivo
                $arquivo_impressao = file_get_contents($fileTmpPath);
        
                // Validação básica
                if (!empty($numero_paginas) && !empty($numero_copias) && !empty($setor) && !empty($corcopia) && !empty($dia_entrega) && !empty($arquivo_impressao)) {
                    try {
                        // Conecta ao banco de dados
                        $pdo = Database::connect();
        
                        // Prepara a query inicial
                        $query = "INSERT INTO solicitacao (numero_paginas, numero_copias, setor, corcopia, dia_entrega, arquivo_impressao, usuario, id_usuario, funcao_usuario, data_solicitacao, total_solicitacao";
        
                        // Se a função do usuário for Coordenação, Direção ou Administrador, adiciona o campo status e data_confirmacao
                        if ($funcao_usuario === 'Coordenação' || $funcao_usuario === 'Direção' || $funcao_usuario === 'Administrador') {
                            $query .= ", status, data_confirmacao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'aprovado', ?)";
                        } else {
                            // Caso contrário, não inclui o campo status na query (vai usar o padrão 'pendente' do banco)
                            $query .= ") VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        }
        
                        // Prepara e executa a query
                        $stmt = $pdo->prepare($query);
                        // Prepara os dados a serem inseridos
                        $params = [
                            $numero_paginas,
                            $numero_copias,
                            $setor,
                            $corcopia,
                            $dia_entrega,
                            $arquivo_impressao,
                            $usuario,
                            $id_usuario,
                            $funcao_usuario,
                            $data_solicitacao,
                            $total_solicitacao
                        ];
        
                        // Adiciona a data de confirmação se necessário
                        if ($funcao_usuario === 'Coordenação' || $funcao_usuario === 'Direção' || $funcao_usuario === 'Administrador') {
                            $params[] = $data_solicitacao; // Adiciona data_solicitacao como data_confirmacao
                        }
        
                        // Executa a query com os valores
                        $stmt->execute($params);
        
                        // Pega o ID da solicitação inserida
                        $id_solicitacao = $pdo->lastInsertId();
                        $_SESSION['id_solicitacao'] = $id_solicitacao;
        
                        // Define uma mensagem de sucesso na sessão
                        $_SESSION['mensagem_sucesso'] = "Solicitação enviada com sucesso. ID da solicitação: " . $id_solicitacao;
        
                        // Redireciona para evitar o reenvio do formulário
                        header("Location: " . INCLUDE_PATH . "solicitacao");
                        exit();
                    } catch (PDOException $e) {
                        // Define uma mensagem de erro na sessão
                        $_SESSION['mensagem_erro'] = "Erro ao enviar a solicitação: " . $e->getMessage();
        
                        // Redireciona para evitar o reenvio do formulário
                        header("Location: " . INCLUDE_PATH . "solicitacao");
                        exit();
                    }
                } else {
                    $_SESSION['mensagem_erro'] = "Por favor, preencha todos os campos.";
                    header("Location: " . INCLUDE_PATH . "solicitacao");
                    exit();
                }
            } else {
                $_SESSION['mensagem_erro'] = "Nenhum arquivo foi enviado ou ocorreu um erro no upload.";
                header("Location: " . INCLUDE_PATH . "solicitacao");
                exit();
            }
        }
        
        
        $todassolicitacoes = $this->getSolicitacoestodas();
        $todassolicitacoesnumero = $this->todassolicitacoesnumero();
        $Solicitacoesimpressas = $this->getSolicitacoesimpressas();
        $Solicitacoesimpressasnumero = $this->solicitacoesimpressasnumero();
        $Solicitacoesaprovadas = $this->getSolicitacoesaprovadas();
        $Solicitacoesaprovadasnumero = $this->solicitacoesaprovadasnumero();
        $Solicitacoespendentes = $this->getSolicitacoespendentes();  
        $solicitacoespendentesnumero = $this->solicitacoespendentesnumero();
        $Solicitacoesreprovadas = $this-> getSolicitacoesreprovadas();
        $Solicitacoesreprovadanumero = $this-> solicitacoesreprovadanumero();
          
        // Renderiza a página com as opções e exibe as mensagens
        $this->view->render(array(
            "titulo" => "Solicitação",
            "todassolicitacoes" => $todassolicitacoes,
            "Solicitacoesaprovadas" => $Solicitacoesaprovadas,
            "Solicitacoesaprovadasnumero" => $Solicitacoesaprovadasnumero,
            "Solicitacoesimpressas" => $Solicitacoesimpressas,
            "Solicitacoespendentes" => $Solicitacoespendentes,
            "Solicitacoesimpressasnumero" => $Solicitacoesimpressasnumero,
            "solicitacoespendentesnumero" => $solicitacoespendentesnumero,
            "todassolicitacoesnumero" => $todassolicitacoesnumero,
            "Solicitacoesreprovadas" => $Solicitacoesreprovadas,
            "Solicitacoesreprovadanumero" => $Solicitacoesreprovadanumero,
            "opcoes_setor" => self::SETOR,
            "opcoes_cor" => self::COR
        ));
    }
    
    
    private function getSolicitacoestodas() {
        // Query para selecionar todas as solicitações
        $stmt = $this->pdo->prepare("SELECT * FROM solicitacao");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function todassolicitacoesnumero() {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT COUNT(*) AS total FROM solicitacao");
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row['total'];
    }
    

    private function getSolicitacoesimpressas() {
        // Verifica se a sessão do usuário está definida
        if (isset($_SESSION['usuario_id'])) {
            // Obtém o nome do usuário logado
            $usuario_id = $_SESSION['usuario_id'];
    
            // Query para selecionar todas as solicitações aprovadas do usuário logado
            $stmt = $this->pdo->prepare("SELECT * FROM solicitacao WHERE status = 'Impresso' AND id_usuario = :usuario_id");
            $stmt->bindParam(':usuario_id', $usuario_id, \PDO::PARAM_STR);
            $stmt->execute();
    
            // Retorna todas as solicitações aprovadas do usuário
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            // Retorna um array vazio se o usuário não estiver logado
            return [];
        }
    }
    public function solicitacoesimpressasnumero() {
        // Verifica se a sessão do usuário está definida
        if (isset($_SESSION['usuario_id'])) {
            // Obtém o nome do usuário logado
            $usuario_id = $_SESSION['usuario_id'];
    
            // Query para contar as solicitações aprovadas do usuário logado
            $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM solicitacao WHERE status = 'Impresso' AND id_usuario = :usuario_id");
            $stmt->bindParam(':usuario_id', $usuario_id, \PDO::PARAM_STR);
            $stmt->execute();
    
            // Obtém o resultado e retorna o total de solicitações aprovadas
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $row['total'];
        } else {
            // Se o usuário não estiver logado, retorna 0
            return 0;
        }
    }
    private function getSolicitacoesaprovadas() {
        // Verifica se a sessão do usuário está definida
        if (isset($_SESSION['usuario_id'])) {
            // Obtém o nome do usuário logado
            $usuario_id = $_SESSION['usuario_id'];
    
            // Query para selecionar todas as solicitações aprovadas do usuário logado
            $stmt = $this->pdo->prepare("SELECT * FROM solicitacao WHERE status = 'Aprovado' AND id_usuario = :usuario_id");
            $stmt->bindParam(':usuario_id', $usuario_id, \PDO::PARAM_STR);
            $stmt->execute();
    
            // Retorna todas as solicitações aprovadas do usuário
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            // Retorna um array vazio se o usuário não estiver logado
            return [];
        }
    }
    public function solicitacoesaprovadasnumero() {
        // Verifica se a sessão do usuário está definida
        if (isset($_SESSION['usuario_id'])) {
            // Obtém o ID do usuário logado
            $usuario_id = $_SESSION['usuario_id'];
    
            // Query para contar as solicitações aprovadas do usuário logado
            $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM solicitacao WHERE status = 'Aprovado' AND id_usuario = :usuario_id");
            $stmt->bindParam(':usuario_id', $usuario_id, \PDO::PARAM_INT);
            $stmt->execute();
    
            // Obtém o resultado e retorna o total de solicitações aprovadas
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $row['total'];
        } else {
            // Se o usuário não estiver logado, retorna 0
            return 0;
        }
    }
    
    
    private function getSolicitacoespendentes() {
        // Verifica se a sessão do usuário está definida
        if (isset($_SESSION['usuario_id'])) {
            // Obtém o nome do usuário logado
            $usuario_id = $_SESSION['usuario_id'];
    
            // Query para selecionar apenas as solicitações pendentes do usuário logado
            $stmt = $this->pdo->prepare("SELECT * FROM solicitacao WHERE status = 'Pendente' AND id_usuario = :usuario_id");
            $stmt->bindParam(':usuario_id', $usuario_id, \PDO::PARAM_STR);
            $stmt->execute();
            
            // Retorna os resultados
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            // Se o usuário não estiver logado, retorna um array vazio
            return [];
        }
    }
    public function solicitacoespendentesnumero() {
        // Verifica se a sessão do usuário está definida
        if (isset($_SESSION['usuario_id'])) {
            // Obtém o nome do usuário logado
            $usuario_id = $_SESSION['usuario_id'];
    
            // Query para contar as solicitações pendentes do usuário logado
            $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM solicitacao WHERE status = 'Pendente' AND id_usuario = :usuario_id");
            $stmt->bindParam(':usuario_id', $usuario_id, \PDO::PARAM_STR);
            $stmt->execute();
    
            // Obtém o resultado da query
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $row['total'];  // Retorna o número de solicitações pendentes do usuário
        } else {
            // Se o usuário não estiver logado, retorna 0
            return 0;
        }
    }    
    private function getSolicitacoesreprovadas() {
        // Verifica se a sessão do usuário está definida
        if (isset($_SESSION['usuario_id'])) {
            // Obtém o nome do usuário logado
            $usuario_id = $_SESSION['usuario_id'];
    
            // Query para selecionar as solicitações reprovadas do usuário logado
            $stmt = $this->pdo->prepare("SELECT * FROM solicitacao WHERE status = 'Reprovado' AND id_usuario = :usuario_id");
            $stmt->bindParam(':usuario_id', $usuario_id, \PDO::PARAM_STR);
            $stmt->execute();
    
            // Retorna o resultado da consulta
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            // Se o usuário não estiver logado, retorna um array vazio
            return [];
        }
    }
    
    public function solicitacoesreprovadanumero() {
        // Verifica se a sessão do usuário está definida
        if (isset($_SESSION['usuario_id'])) {
            // Obtém o nome do usuário logado
            $usuario_id = $_SESSION['usuario_id'];
    
            // Query para contar as solicitações reprovadas do usuário logado
            $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM solicitacao WHERE status = 'Reprovado' AND id_usuario = :usuario_id");
            $stmt->bindParam(':usuario_id', $usuario_id, \PDO::PARAM_STR);
            $stmt->execute();
    
            // Obtém o resultado
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $row['total'];  // Retorna o total de solicitações reprovadas
        } else {
            // Se o usuário não estiver logado, retorna 0
            return 0;
        }
    }
    
    
    
      
}
?>