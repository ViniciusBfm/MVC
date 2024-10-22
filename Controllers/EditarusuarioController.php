<?php 
namespace Controllers;

use Models\Database;

class EditarusuarioController {

    public function __construct() {
        $this->view = new \Views\MainView('editarusuario');
    }

    const FUNCOES = ['Administrador','Professor','Coordenação', 'Direção','Reprografia'];
    
    public function executar() {
        // Verifica se o usuário está logado
        if (!isset($_SESSION['usuario_logado'])) {
            header('Location: ' . INCLUDE_PATH . 'login');
            exit();
        }

        // Obtém o ID do usuário da URL
        $id = $_GET['id'] ?? '';

        if (!empty($id) && is_numeric($id)) {
            // Conecta ao banco de dados e busca o usuário pelo ID
            try {
                $pdo = Database::connect();
                $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
                $stmt->execute([$id]);
                $usuario = $stmt->fetch();

                if ($usuario) {
                    // Se o usuário foi encontrado, exibe o formulário com os dados do usuário
                    $this->view->render(array(
                        "titulo" => "Editar Usuário",
                        "usuario" => $usuario,
                        "opcoes_funcao" => self::FUNCOES,
                    ));
                } else {
                    $_SESSION['erro_editarusuario'] = "Usuário não encontrado.";
                    header("Location: " . INCLUDE_PATH . "paineladmin");
                    exit();
                }

            } catch (Exception $e) {
                $_SESSION['erro_editarusuario'] = "Erro de conexão com o banco de dados: " . $e->getMessage();
                header("Location: " . INCLUDE_PATH . "paineladmin");
                exit();
            }
        } else {
            $_SESSION['erro_editarusuario'] = "ID inválido.";
            header("Location: " . INCLUDE_PATH . "paineladmin");
            exit();
        }
    }
}


?>