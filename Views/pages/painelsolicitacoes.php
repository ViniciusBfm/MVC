<section class="container-box">
    <div class="titulo bg-primary text-white">
        <p class="fs-3 fw-semibold">Painel de solicitações</p>
    </div>
    <div class="  bg-white p-3 my-3">
        <div id="usuarios" class="conteudo2">
            <h1 class="fs-5 fw-semibold">Solicitações pendentes</h1>
            <table id="painelsolicitacao-table" class="display text-center">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Solicitado em</th>
                        <th>Total</th>
                        <th>Cor</th>
                        <th>Data impressão</th>
                        <th>Arquivo</th>
                        <th>Usuário</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Verifica se o array de solicitações pendentes existe e não está vazio -->
                    <?php if (isset($solicitacoespendentes) && !empty($solicitacoespendentes)): ?>
                    <!-- Itera sobre cada solicitação pendente e exibe uma linha na tabela -->
                    <?php foreach ($solicitacoespendentes as $solicitacao): ?>
                    <tr>
                        <td><?= htmlspecialchars($solicitacao['id']); ?></td>
                        <td>
                            <?php
                // Cria um objeto DateTime a partir da data do banco
                $data = new DateTime($solicitacao['data_solicitacao']);
                // Formata a data para d-m-Y H:i:s
                echo htmlspecialchars($data->format('d/m/Y H:i:s'));
            ?>
                        </td>
                        <td><?= htmlspecialchars($solicitacao['total_solicitacao']); ?></td>
                        <td><?= htmlspecialchars($solicitacao['corcopia']); ?></td>
                        <td>
                            <?php
                $data = new DateTime($solicitacao['dia_entrega']);
                echo htmlspecialchars($data->format('d/m/Y'));
            ?>
                        </td>
                        <td>
                            <form action="<?= INCLUDE_PATH . 'baixarsolicitacao'; ?>" method="POST">
                                <input type="hidden" name="action" value="baixarsolicitacao">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($solicitacao['id']); ?>">
                                <button type="submit" class="btn btn-primary">Baixar Arquivo</button>
                            </form>
                        </td>
                        <td><?= htmlspecialchars($solicitacao['usuario']); ?></td>
                        <td>
                            <form action="<?= INCLUDE_PATH ?>alterarstatus" method="POST">
                                <!-- Campo oculto para enviar o ID da solicitação -->
                                <input type="hidden" name="id" value="<?= $solicitacao['id'] ?>">

                                <!-- Botão para aprovar -->
                                <button type="submit" name="status" value="aprovado" class="btn btn-success">
                                    <img src="<?= INCLUDE_IMAGES; ?>/confirmar-branco.png" alt="">
                                </button>

                                <!-- Botão para reprovar -->
                                <button type="submit" name="status" value="reprovado" class="btn btn-danger">
                                    <img src="<?= INCLUDE_IMAGES; ?>/recusar-branco.png" alt="">
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <!-- Caso não haja solicitações pendentes, exibe uma mensagem -->
                    <tr>
                        <td colspan="8">Nenhuma solicitação pendente encontrada.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Mostrar mensagem de sucesso ou erro aqui -->
    <?php if (isset($_SESSION['mensagem_status'])): ?>
    <div class="row row-solicitacao">
        <div class="col-md-12">
            <div class="alert alert-dismissible fade show alert-warning" role="alert">
                <?= $_SESSION['mensagem_status']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php unset($_SESSION['mensagem_status']); // Limpa a mensagem após exibir ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['mensagem_erro'])): ?>
    <div class="row row-solicitacao">
        <div class="col-md-12">
            <div class="alert alert-dismissible fade show alert-dark" role="alert">
                <?= $_SESSION['mensagem_erro']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php unset($_SESSION['mensagem_erro']); // Limpa a mensagem após exibir ?>
    <?php endif; ?>
</section>
<script>
//Solicitações aprovadas tabela 
$(document).ready(function() {

    // Inicialize DataTable para a tabela de aprovações
    $('#painelsolicitacao-table').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json'
        },
        order: [
            [0, 'desc']
        ] // 0 é o índice da coluna de data, 'desc' para ordenação descendente
        // Adicione outras opções de DataTables conforme necessário
    });

});
</script>