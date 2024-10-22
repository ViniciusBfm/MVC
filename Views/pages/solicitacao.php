<section class="container-box">
    <div class="titulo bg-primary text-white d-flex align-items-center justify-content-between">
        <p class="fs-3 fw-semibold">Solicitação</p>
        <p class="notificacao mx-4" data-bs-toggle="modal" data-bs-target="#exampleModal4"><img
                src="<?= INCLUDE_IMAGES; ?>/notificacao.png" alt=""><strong
                style="border: 1px solid #f4a002; padding: 11px; border-radius: 50%; width: 22px; height: 22px; display: inline-flex; justify-content: center; align-items: center; background-color: #dc3546;">
                <?=$Solicitacoesreprovadanumero ?>
            </strong>
        </p>
    </div>
    <div class="menu-solicitacao">
        <div class="d-flex justify-content-center align-items-start gap-3 w-100 px-2 solicitacao-container">
            <div class="box-solicitacao p-2" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0">
                <div class="container-solicitacao">
                    <div class="titulo-solicitacao">
                        <h4 class="fs-5">Solicitar impressão</h4>
                        <p>Clique aqui</p>
                    </div>
                    <div class="img-solicitacao">
                        <img class="logo" src="<?= INCLUDE_IMAGES; ?>/solicitarimpressao.png" alt="Repros">
                    </div>
                </div>
            </div>
            <div class="box-solicitacao p-2" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2">
                <div class="container-solicitacao">
                    <div class="titulo-solicitacao">
                        <h4 class="fs-5">Impressas</h4>
                        <p><?= htmlspecialchars($Solicitacoesimpressasnumero); ?> solicitações</p>
                    </div>
                    <div class="img-solicitacao">
                        <img class="logo" src="<?= INCLUDE_IMAGES; ?>/todasimpressoes.png" alt="Repros">
                    </div>
                </div>
            </div>
            <div class=" box-solicitacao p-2" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3">
                <div class="container-solicitacao">
                    <div class="titulo-solicitacao">
                        <h4 class="fs-5">Pendentes</h4>
                        <p><?= htmlspecialchars($solicitacoespendentesnumero); ?> solicitações</p>
                    </div>
                    <div class="img-solicitacao">
                        <img class="logo" src="<?= INCLUDE_IMAGES; ?>/pendenteimpressao.png" alt="Repros">
                    </div>
                </div>
            </div>
            <div class=" box-solicitacao p-2" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1">
                <div class="container-solicitacao">
                    <div class="titulo-solicitacao">
                        <h4 class="fs-5">Aprovadas</h4>
                        <p><?=$Solicitacoesaprovadasnumero ?> solicitações</p>
                    </div>
                    <div class="img-solicitacao">

                        <img class="logo" src="<?= INCLUDE_IMAGES; ?>/aprovadasimpressao.png" alt="Repros">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="carouselExampleIndicators" class="carousel slide carousel2">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <h1 class="fs-5 fw-semibold" style="color: #0b6eff;">Solicitar impressão</h1>
                <form action="<?= INCLUDE_PATH . 'solicitacao' ?>" method="POST" enctype="multipart/form-data">
                    <div class="row row-solicitacao">
                        <div class="col-md-6">
                            <label for="numerodepaginas" class="form-label">Número de páginas</label>
                            <input placeholder="N° de paginas do arquivo" type="number" class="form-control"
                                name="numero_paginas" id="numerodepaginas">
                        </div>
                        <div class="col-md-6 no-padding">
                            <label for="numerodecopias" class="form-label">Número de cópias</label>
                            <input placeholder="Nº de copias solicitadas" type="number" class="form-control"
                                name="numero_copias" id="numerodecopias">
                        </div>
                    </div>
                    <div class="row row-solicitacao">
                        <div class="col-md-6">
                            <label for="setor" class="form-label">Setor</label>
                            <select name="setor" id="setor" class="form-control form-select" required>
                                <option value="" selected disabled>Selecione um setor</option>
                                <?php foreach ($arr['opcoes_setor'] as $setores): ?>
                                <option value="<?= htmlspecialchars($setores); ?>"><?= htmlspecialchars($setores); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="corcopia" class="form-label">Cor da cópia</label>
                            <select name="corcopia" id="corcopia" class="form-control form-select" required>
                                <option value="" selected disabled>Selecione a cor</option>
                                <?php foreach ($arr['opcoes_cor'] as $cor): ?>
                                <option value="<?= htmlspecialchars($cor); ?>"><?= htmlspecialchars($cor); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row row-solicitacao">
                        <div class="col-md-6">
                            <label for="diaentrega" class="form-label">Dia para entrega</label>
                            <input type="date" name="dia_entrega" class="form-control" id="diaentrega">
                        </div>
                        <div class="col-md-6">
                            <label for="arquivoimpressao" class="form-label">Arquivo para impressão:</label>
                            <label for="arquivo" class="file-upload-container">
                                <div class="file-upload-button">Selecionar Arquivo</div>
                                <input type="file" name="arquivo_impressao" id="arquivo" accept=".pdf, .doc, .docx"
                                    required class="file-input">
                                <div class="file-name" id="file-name">Nenhum arquivo selecionado</div>
                            </label>
                        </div>
                    </div>
                    <div class="row row-solicitacao">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary w-100" style="margin-top: 10px;">Enviar
                                solicitação</button>
                        </div>
                    </div>

                    <!-- Mostrar mensagem de sucesso ou erro aqui -->
                    <?php if (isset($_SESSION['mensagem_sucesso'])): ?>
                    <div class="row row-solicitacao">
                        <div class="col-md-12">
                            <div class="alert alert-dismissible fade show alert-warning" role="alert">
                                <?= $_SESSION['mensagem_sucesso']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    <?php unset($_SESSION['mensagem_sucesso']); // Limpa a mensagem após exibir ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['mensagem_erro'])): ?>
                    <div class="row row-solicitacao">
                        <div class="col-md-12">
                            <div class="alert alert-dismissible fade show alert-dark" role="alert">
                                <?= $_SESSION['mensagem_erro']; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    <?php unset($_SESSION['mensagem_erro']); // Limpa a mensagem após exibir ?>
                    <?php endif; ?>
                </form>



            </div>
            <div class="carousel-item">
                <h1 class="fs-5 fw-semibold" style="color: #212429;">Solicitações Aprovadas</h1>
                <div id="aprovadassolicitacoes" class="conteudo2 text-center">
                    <table id="todas-colicitacoes-table" class="display">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Solicitado em</th>
                                <th>Total</th>
                                <th>Cor</th>
                                <th>Data impressão</th>
                                <th>Arquivo</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Verifica se o array de usuários existe e não está vazio -->
                            <?php if (isset($Solicitacoesaprovadas) && !empty($Solicitacoesaprovadas)): ?>
                            <!-- Itera sobre cada usuário e exibe uma linha na tabela -->
                            <?php foreach ($Solicitacoesaprovadas as $todassolicitacao): ?>
                            <tr>
                                <td><?= htmlspecialchars($todassolicitacao['id']); ?></td>
                                <td>
                                    <?php
                                    // Cria um objeto DateTime a partir da data do banco
                                    $data = new DateTime($todassolicitacao['data_solicitacao']);
                                    // Formata a data para d-m-Y H:i:s
                                    echo htmlspecialchars($data->format('d-m-Y H:i:s'));
                                    ?>
                                </td>
                                <td><?= htmlspecialchars($todassolicitacao['total_solicitacao']); ?></td>
                                <td><?= htmlspecialchars($todassolicitacao['corcopia']); ?></td>
                                <td>
                                    <?php
                                        $data = new DateTime($todassolicitacao['dia_entrega']);
                                        echo htmlspecialchars($data->format('d-m-Y'));
                                    ?>
                                </td>

                                <td>
                                    <form action="<?= INCLUDE_PATH . 'baixarsolicitacao'; ?>" method="POST">
                                        <input type="hidden" name="action" value="baixarsolicitacao">
                                        <input type="hidden" name="id"
                                            value="<?= htmlspecialchars($todassolicitacao['id']); ?>">
                                        <button type="submit" class="btn btn-primary">Baixar Arquivo</button>
                                    </form>
                                </td>
                                <td><?= htmlspecialchars($todassolicitacao['status']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <!-- Caso não haja usuários, exibe uma mensagem -->
                            <tr>
                                <td colspan="8">Nenhuma solicitação aprovada encontrada.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="carousel-item">
                <h1 class="fs-5 fw-semibold" style="color: #00ad6c;">Solicitações impressas</h1>
                <div id="aprovadassolicitacoes" class="conteudo2  text-center">
                    <table id="aprovadas-table" class="display">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Solicitado em</th>
                                <th>Total</th>
                                <th>Cor</th>
                                <th>Data impressão</th>
                                <th>Arquivo</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Verifica se o array de solicitações aprovadas existe e não está vazio -->
                            <?php if (isset($Solicitacoesimpressas) && !empty($Solicitacoesimpressas)): ?>
                            <!-- Itera sobre cada solicitação aprovada e exibe uma linha na tabela -->
                            <?php foreach ($Solicitacoesimpressas as $solicitacao): ?>
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
                                        echo htmlspecialchars($data->format('d-m-Y'));
                                    ?>
                                </td>

                                <td>
                                    <form action="<?= INCLUDE_PATH . 'baixarsolicitacao'; ?>" method="POST">
                                        <input type="hidden" name="action" value="baixarsolicitacao">
                                        <input type="hidden" name="id"
                                            value="<?= htmlspecialchars($solicitacao['id']); ?>">
                                        <button type="submit" class="btn btn-primary">Baixar Arquivo</button>
                                    </form>
                                </td>
                                <td><img src="<?= INCLUDE_IMAGES; ?>/confirmar.png" alt=""></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <!-- Caso não haja solicitações aprovadas, exibe uma mensagem -->
                            <tr>
                                <td colspan="8">Nenhuma solicitação impressa encontrada.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="carousel-item">
                <h1 class="fs-5 fw-semibold" style="color: #f4a002;">Solicitações pendentes</h1>
                <div id="aprovadassolicitacoes" class="conteudo2 text-center">
                    <table id="pedentes-table" class="display">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Solicitado em</th>
                                <th>Total</th>
                                <th>Cor</th>
                                <th>Data impressão</th>
                                <th>Arquivo</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Verifica se o array de solicitações aprovadas existe e não está vazio -->
                            <?php if (isset($Solicitacoespendentes) && !empty($Solicitacoespendentes)): ?>
                            <!-- Itera sobre cada solicitação aprovada e exibe uma linha na tabela -->
                            <?php foreach ($Solicitacoespendentes as $solicitacao): ?>
                            <tr>
                                <td><?= htmlspecialchars($solicitacao['id']); ?></td>
                                <td>
                                    <?php
                                    // Cria um objeto DateTime a partir da data do banco
                                    $data = new DateTime($solicitacao['data_solicitacao']);
                                    // Formata a data para d-m-Y H:i:s
                                    echo htmlspecialchars($data->format('d-m-Y H:i:s'));
                                    ?>
                                </td>
                                <td><?= htmlspecialchars($solicitacao['total_solicitacao']); ?></td>
                                <td><?= htmlspecialchars($solicitacao['corcopia']); ?></td>
                                <td>
                                    <?php
                                        $data = new DateTime($solicitacao['dia_entrega']);
                                        echo htmlspecialchars($data->format('d-m-Y'));
                                    ?>
                                </td>

                                <td>
                                    <form action="<?= INCLUDE_PATH . 'baixarsolicitacao'; ?>" method="POST">
                                        <input type="hidden" name="action" value="baixarsolicitacao">
                                        <input type="hidden" name="id"
                                            value="<?= htmlspecialchars($solicitacao['id']); ?>">
                                        <button type="submit" class="btn btn-primary">Baixar Arquivo</button>
                                    </form>
                                </td>
                                <td><?= htmlspecialchars($solicitacao['status']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <!-- Caso não haja solicitações aprovadas, exibe uma mensagem -->
                            <tr>
                                <td colspan="8">Nenhuma solicitação pendente encontrada.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel4" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Notificações</h1>
                <div data-bs-theme="dark" class="ms-auto">
                    <button type="button" data-bs-theme="dark" class="btn-close " data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
            </div>
            <?php if (isset($Solicitacoesreprovadas) && !empty($Solicitacoesreprovadas)): ?>
            <div class="modal-body w-100 ">
                <!-- Mostrar mensagem de sucesso ou erro aqui -->
                <?php if (isset($_SESSION['sucesso_excluirsolicitacao'])): ?>
                <div class="row row-solicitacao">
                    <div class="col-md-12">
                        <div class="alert alert-dismissible fade show alert-warning" role="alert">
                            <?= $_SESSION['sucesso_excluirsolicitacao']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
                <?php unset($_SESSION['sucesso_excluirsolicitacao']); // Limpa a mensagem após exibir ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['erro_excluirsolicitacao'])): ?>
                <div class="row row-solicitacao">
                    <div class="col-md-12">
                        <div class="alert alert-dismissible fade show alert-dark" role="alert">
                            <?= $_SESSION['erro_excluirsolicitacao']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
                <?php unset($_SESSION['erro_excluirsolicitacao']); // Limpa a mensagem após exibir ?>
                <?php endif; ?>
                <ol class="list-group list-group-numbered">
                    <!-- Itera sobre cada solicitação e exibe uma linha na lista -->
                    <?php foreach ($Solicitacoesreprovadas as $todassolicitacao): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center my-1">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold"><span class="text-danger">Cancelada: </span>Solicitação N°
                                <?= htmlspecialchars($todassolicitacao['id']); ?>

                            </div>
                            Motivo: <span>
                                <?= strtolower(htmlspecialchars($todassolicitacao['observacao'])); ?>
                            </span>
                            <div class=" d-flex gap-2 align-items-center ">
                                <form action="<?= INCLUDE_PATH . 'reenviarsolicitacao' ?>" method="POST">
                                    <input type="hidden" name="id" value="<?= $todassolicitacao['id']; ?>">
                                    <input type="hidden" name="action" value="reenviar">
                                    <!-- Indica que a ação é excluir -->
                                    <button type="submit" class="btn btn-warning btn-sm my-1">Reenviar
                                    </button>
                                </form>
                                <form action="<?= INCLUDE_PATH . 'deletarsolicitacao' ?>" method="POST">
                                    <input type="hidden" name="id" value="<?= $todassolicitacao['id']; ?>">
                                    <input type="hidden" name="action" value="excluir">
                                    <!-- Indica que a ação é excluir -->
                                    <button type="submit" class="btn btn-danger btn-sm my-1">Excluir
                                    </button>
                                </form>
                            </div>
                        </div>

                        <span class="badge text-bg-primary rounded-pill">
                            <?php
                            // Cria um objeto DateTime a partir da data do banco
                            $data = new DateTime($todassolicitacao['data_solicitacao']);
                            // Formata a data para d-m-Y
                            echo htmlspecialchars($data->format('d/m/y'));
                        ?>
                        </span>

                    </li>
                    <?php endforeach; ?>

                </ol>
            </div>
            <?php else: ?>
            <div class="modal-body w-100">
                <ol class="list-group list-group-numbered">
                    <li class="list-group-item">Nenhuma solicitação reprovada encontrada.</li>
                </ol>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>
<?php if (isset($_SESSION['mensagem_recusar'])): ?>
<div class="alert alert-danger">
    <?= $_SESSION['mensagem_recusar']; ?>
</div>
<?php unset($_SESSION['mensagem_recusar']); ?>
<?php endif; ?>


</div>
<script>
//Solicitações aprovadas tabela 
$(document).ready(function() {

    // Inicialize DataTable para a tabela de aprovações
    $('#aprovadas-table').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json'
        },
        order: [
            [0, 'desc']
        ] // 0 é o índice da coluna de data, 'desc' para ordenação descendente
        // Adicione outras opções de DataTables conforme necessário
    });
    // Inicialize DataTable para a tabela de aprovações
    $('#todas-colicitacoes-table').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json'
        },
        order: [
            [0, 'desc']
        ] // 0 é o índice da coluna de data, 'desc' para ordenação descendente
        // Adicione outras opções de DataTables conforme necessário
    });
});
$(document).ready(function() {
    $('#pedentes-table').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json'
        },
        order: [
            [0, 'desc']
        ] // 0 é o índice da coluna de data, 'desc' para ordenação descendente
        // Adicione outras opções de DataTables conforme necessário
    });
});
// mostrar o nome do input de selecionar arquivos
document.getElementById('arquivo').addEventListener('change', function(e) {
    var fileName = e.target.files[0].name;
    document.getElementById('file-name').innerText = fileName;
    var selecionararquivo = document.querySelector(".file-upload-button")
    selecionararquivo.innerHTML = 'Arquivo Selecionado'
});
</script>