<?php 
namespace Controllers;

use Models\Database;

class DownloadController {
    public function baixarSolicitacao() {
        if (isset($_POST['id'])) {
            $id = $_POST['id']; // ID da solicitação
            $pdo = Database::connect();
            
            // Prepara a consulta para obter o arquivo do banco de dados
            $stmt = $pdo->prepare("SELECT arquivo_impressao FROM solicitacao WHERE id = ?");
            $stmt->execute([$id]);
            $file = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($file) {
                $arquivoImpressao = $file['arquivo_impressao']; // O conteúdo binário do arquivo (BLOB)

                // Definindo os cabeçalhos para forçar o download
                header('Content-Description: File Transfer');
                header('Content-Type: application/pdf'); // Alterar para o tipo de arquivo correto
                header('Content-Disposition: attachment; filename="Solicitação N° ' . $id . '.pdf"'); // Nome do arquivo
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . strlen($arquivoImpressao));

                // Envia o arquivo para o navegador
                echo $arquivoImpressao;
                exit();
            } else {
                echo "Arquivo não encontrado.";
                exit();
            }
        } else {
            echo "ID inválido.";
            exit();
        }
    }
}


?>