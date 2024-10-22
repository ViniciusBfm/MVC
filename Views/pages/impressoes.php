<section class="container-box">
    <div class="titulo bg-primary text-white">
        <p class="fs-3 fw-semibold" style="margin: 0;">Todas as impressões</p>
        <p>Realizadas até hoje (<?php echo date("d/m/y");?>).</p>
    </div>
    <div class="bg-white p-3 my-3">
        <h5>Total de impressões: <?= htmlspecialchars($totalPaginas); ?></h5>
        <table id="todassolicitacoes-table" class="display text-center">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Impressão</th>
                    <th>Paginas</th>
                    <th>Usuário</th>
                </tr>
            </thead>
            <tbody>
                <!-- Verifica se o array de solicitações aprovadas existe e não está vazio -->
                <?php if (isset($todassolicitacoes) && !empty($todassolicitacoes)): ?>
                <!-- Itera sobre cada solicitação aprovada e exibe uma linha na tabela -->
                <?php foreach ($todassolicitacoes as $solicitacao): ?>
                <tr>
                    <td><strong><?= htmlspecialchars($solicitacao['id']); ?></strong></td>
                    <td>
                        <?php
                            // Cria um objeto DateTime a partir da data do banco
                            $data = new DateTime($solicitacao['data_impresso']);
                            // Formata a data para d-m-Y H:i:s
                            echo htmlspecialchars($data->format('d/m/y H:i:s'));
                            ?>
                    </td>
                    <td><?= htmlspecialchars($solicitacao['total_solicitacao']); ?></td>
                    <td><?= htmlspecialchars($solicitacao['usuario']); ?></td>
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
</section>
<script>
//Solicitações aprovadas tabela 
$(document).ready(function() {

    // Inicialize DataTable para a tabela de aprovações
    $('#todassolicitacoes-table').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json'
        },
        order: [
            [1, 'desc']
        ] // 0 é o índice da coluna de data, 'desc' para ordenação descendente
        // Adicione outras opções de DataTables conforme necessário
    });
});
</script>