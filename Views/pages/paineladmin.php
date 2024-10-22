<section class="container-box">
    <div class="titulo bg-primary text-white">
        <p class="fs-3 fw-semibold">Painel do administrador</p>
    </div>
    <div class=" bg-white w-100">
        <div class="row d-flex justify-content-between m-0 p-3">
            <div class="col-12 col-md-3 paineladmin-box">
                <p class="fs-5 fw-semibold">Usuários</p>
                <p class="fw-medium text-primary" style="cursor: pointer;" data-bs-toggle="modal"
                    data-bs-target="#exampleModal2">
                    Adicionar um usuário</p>
                <p class=" fw-medium text-primary" style="cursor: pointer;" data-bs-toggle="modal"
                    data-bs-target="#exampleModal3">
                    Excluir um usuário</p>
                <p class="fw-medium text-primary" style="cursor: pointer;" data-bs-target="#exampleModalToggle"
                    data-bs-toggle="modal">
                    Atualizar um usuário</p>
            </div>
            <div class="col-12 col-md-3 paineladmin-box">
                <p class="fs-5 fw-semibold">Solicitações</p>
                <p class="fw-medium text-primary">Pendentes:
                    <strong><?= htmlspecialchars($solicitacoespendentesnumero); ?></strong>
                </p>
                <p class="fw-medium text-primary">Aprovadas:
                    <strong><?= htmlspecialchars($Solicitacoesaprovadasnumero); ?></strong>
                </p>
                <p class="fw-medium text-primary">Impressas:
                    <strong><?= htmlspecialchars($Solicitacoesimpressasnumero); ?></strong>
                </p>
                <p class="fw-medium text-primary">Reprovadas:
                    <strong><?= htmlspecialchars($Solicitacoesreprovadanumero); ?></strong>
                </p>
                <p class="fw-medium text-primary">Total de páginas impressas:
                    <strong><?= htmlspecialchars($totalPaginas); ?></strong>
                </p>
            </div>
            <div class="col-12 col-md-3 paineladmin-box">
                <p class="fs-5 fw-semibold">Informações</p>
                <div class="">
                    <p class="fw-medium text-primary">Adminstradores:
                        <strong><?= htmlspecialchars($totalAdmin); ?></strong>
                    </p>
                    <p class="fw-medium text-primary">Coordenadores:
                        <strong><?= htmlspecialchars($totalcoord); ?></strong>
                    </p>
                </div>
                <div class="">
                    <p class="fw-medium text-primary">Diretores:
                        <strong><?= htmlspecialchars($totaldirecao); ?></strong>
                    </p>
                    <p class="fw-medium text-primary">Reprografia:
                        <strong><?= htmlspecialchars($totalreprografia); ?></strong>
                    </p>
                </div>
                <p class="fw-medium text-primary">Total de usuários:
                    <strong><?= htmlspecialchars($totalUsuarios); ?></strong>
                </p>
            </div>
        </div>
    </div>
    <div class="  bg-white p-3 my-3">
        <div id="usuarios" class="conteudo2">
            <h1 class="fs-5 fw-semibold">Usuários ativos</h1>
            <table id="usuarios-table" class="display text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Matrícula</th>
                        <th>Função</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Verifica se o array de usuários existe e não está vazio -->
                    <?php if (isset($usuarios) && !empty($usuarios)): ?>
                    <!-- Itera sobre cada usuário e exibe uma linha na tabela -->
                    <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['id']); ?></td>
                        <td><?= htmlspecialchars($usuario['nome']); ?></td>
                        <td><?= htmlspecialchars($usuario['matricula']); ?></td>
                        <td><?= htmlspecialchars($usuario['funcao']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <!-- Caso não haja usuários, exibe uma mensagem -->
                    <tr>
                        <td colspan="4">Nenhum usuário encontrado.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Modal de adicionar usuários-->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary ">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Adicionar usuário</h1>
                    <div data-bs-theme="dark" class="ms-auto">
                        <button type="button" data-bs-theme="dark" class="btn-close " data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="<?= INCLUDE_PATH . 'paineladmin' ?>" method="POST">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Insira um nome"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="matricula" class="form-label">Matricula:</label>
                            <input required type="number" class="form-control" id="matricula" name="matricula"
                                placeholder="Insira a matricula">
                        </div>
                        <div class="mb-3">
                            <label for="matricula" class="form-label">Função:</label>
                            <select style="height: 50px;" name="funcao" id="funcao" class="form-control form-select"
                                required>
                                <option value="" selected disabled>Selecione sua função</option>
                                <?php foreach ($arr['opcoes_funcao'] as $opcao): ?>
                                <option value="<?= htmlspecialchars($opcao); ?>"><?= htmlspecialchars($opcao); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail:</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Insira o e-mail" required>
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha:</label>
                            <input required type="password" placeholder="Digite uma senha" class="form-control"
                                id="senha" name="senha">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de excluir usuários -->
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir usuário</h1>
                    <div data-bs-theme="dark" class="ms-auto">
                        <button type="button" data-bs-theme="dark" class="btn-close " data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <table id="usuariosexcluir-table" class="display text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Matrícula</th>
                                <th>Função</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Verifica se o array de usuários existe e não está vazio -->
                            <?php if (isset($usuarios) && !empty($usuarios)): ?>
                            <!-- Itera sobre cada usuário e exibe uma linha na tabela -->
                            <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?= htmlspecialchars($usuario['id']); ?></td>
                                <td><?= htmlspecialchars($usuario['nome']); ?></td>
                                <td><?= htmlspecialchars($usuario['matricula']); ?></td>
                                <td><?= htmlspecialchars($usuario['funcao']); ?></td>
                                <td>
                                    <form action="<?= INCLUDE_PATH . 'paineladmin' ?>" method="POST">
                                        <input type="hidden" name="id" value="<?= $usuario['id']; ?>">
                                        <input type="hidden" name="action" value="excluir">
                                        <!-- Indica que a ação é excluir -->
                                        <button type="submit" class="btn-none"><img
                                                src="<?= INCLUDE_IMAGES; ?>/excluir.png" alt=""></button>
                                    </form>

                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <!-- Caso não haja usuários, exibe uma mensagem -->
                            <tr>
                                <td colspan="4">Nenhum usuário encontrado.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de atualizar os usuários -->
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg ">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Atualizar usuário</h1>
                    <div data-bs-theme="dark" class="ms-auto">
                        <button type="button" data-bs-theme="dark" class="btn-close " data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <table id="usuariosatualizar-table" class="display text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Matrícula</th>
                                <th>Função</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Verifica se o array de usuários existe e não está vazio -->
                            <?php if (isset($usuarios) && !empty($usuarios)): ?>
                            <!-- Itera sobre cada usuário e exibe uma linha na tabela -->
                            <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?= htmlspecialchars($usuario['id']); ?></td>
                                <td><?= htmlspecialchars($usuario['nome']); ?></td>
                                <td><?= htmlspecialchars($usuario['matricula']); ?></td>
                                <td><?= htmlspecialchars($usuario['funcao']); ?></td>
                                <td>
                                    <a href="<?= INCLUDE_PATH . 'editarusuario?id=' . $usuario['id']; ?>"
                                        class="btn btn-primary">Editar</a>
                                </td>

                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <!-- Caso não haja usuários, exibe uma mensagem -->
                            <tr>
                                <td colspan="4">Nenhum usuário encontrado.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</section>
<script>
$(document).ready(function() {

    // Inicialize DataTable para a tabela de aprovações
    $('#usuarios-table').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json'
        },
        order: [
            [0, 'desc']
        ] // 0 é o índice da coluna de data, 'desc' para ordenação descendente
        // Adicione outras opções de DataTables conforme necessário
    });
    $('#usuariosexcluir-table').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json'
        },
        order: [
            [0, 'desc']
        ] // 0 é o índice da coluna de data, 'desc' para ordenação descendente
        // Adicione outras opções de DataTables conforme necessário
    });
    $('#usuariosatualizar-table').DataTable({
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