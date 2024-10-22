<section class="container-box">
    <div class="titulo bg-primary text-white">
        <p class="fs-3 fw-semibold">Painel da reprografia</p>
    </div>
    <div class="  bg-white p-3 my-3">
        <div id="usuarios" class="conteudo2">
            <h1 class="fs-5 fw-semibold">Solicitações aguardando impressão</h1>
            <table id="painelreprografiaaprovados-table" class="display text-center">
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
                    <!-- Verifica se o array de solicitações aprovadas existe e não está vazio -->
                    <?php if (isset($Solicitacoesaprovadas) && !empty($Solicitacoesaprovadas)): ?>
                    <!-- Itera sobre cada solicitação aprovada e exibe uma linha na tabela -->
                    <?php foreach ($Solicitacoesaprovadas as $solicitacao): ?>
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
                            <!-- Formulário para confirmar impressão -->
                            <div class="d-flex gap-2 justify-content-center">
                                <form action="<?= INCLUDE_PATH ?>confirmarimpressao" method="POST">
                                    <input type="hidden" name="id" value="<?= $solicitacao['id'] ?>">
                                    <input type="hidden" name="acao" value="aprovar"> <!-- Adicione este campo -->
                                    <button type="submit" name="status" value="Impresso" class="btn btn-success"><img
                                            src="<?= INCLUDE_IMAGES; ?>/confirmar-branco.png" alt=""></button>
                                </form>
                                <!-- Botão para abrir o modal de recusa -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal5"><img src="<?= INCLUDE_IMAGES; ?>/recusar-branco.png"
                                        alt=""></button>
                            </div>

                            <!-- Modal para relatar problema -->
                            <div class="modal fade" id="exampleModal5" tabindex="-1"
                                aria-labelledby="exampleModalLabel5" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Relatar problema</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Formulário para relatar problema separado do outro -->
                                            <form action="<?= INCLUDE_PATH ?>relatarproblema" method="POST">
                                                <input type="hidden" name="solicitacao_id"
                                                    value="<?= $solicitacao['id'] ?>">
                                                <input type="hidden" name="acao" value="reprovar">
                                                <p>ID da Solicitação: <?= $solicitacao['id'] ?></p>
                                                <div class="form-floating">
                                                    <textarea class="form-control"
                                                        placeholder="Explique o motivo do problema"
                                                        id="floatingTextarea2" name="observacao"
                                                        style="height: 100px"></textarea>
                                                    <label for="floatingTextarea2">Relatar problema</label>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-danger">Reprovar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <!-- Caso não haja solicitações aprovadas, exibe uma mensagem -->
                    <tr>
                        <td colspan="8">Nenhuma solicitação aprovada encontrada.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>
        <?php if (isset($_SESSION['mensagem_recusar'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['mensagem_recusar']; ?>
        </div>
        <?php unset($_SESSION['mensagem_recusar']); ?>
        <?php endif; ?>


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

<!-- Modal de recusar pela reporgrafia -->


<script>
//Solicitações aprovadas tabela 
$(document).ready(function() {

    // Inicialize DataTable para a tabela de aprovações
    $('#painelreprografiaaprovados-table').DataTable({
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