<section class="container-box">
    <div class="titulo bg-primary text-white">
        <p class="fs-3 fw-semibold">Editar Usuário: <span class="fw-normal"
                style="text-transform: capitalize;"><?= $usuario['nome']; ?></span>
        </p>
    </div>
    <form action="<?= INCLUDE_PATH . 'atualizarusuario'; ?>" method="POST" class="form-alterar">
        <input type="hidden" name="id" value="<?= $usuario['id']; ?>">

        <div class="mb-3">
            <div class="fs-5 text-primary fw-semibold">
                Alterar as informações do usuário
            </div>
        </div>

        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" name="nome" value="<?= $usuario['nome']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" value="<?= $usuario['email']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="matricula" class="form-label">Matrícula:</label>
            <input type="text" class="form-control" name="matricula" value="<?= $usuario['matricula']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="funcao" class="form-label">Função:</label>
            <select style="height: 50px;" name="funcao" id="funcao" class="form-control form-select" required>
                <?php foreach ($arr['opcoes_funcao'] as $opcao): ?>
                <option value="<?= htmlspecialchars($opcao); ?>"
                    <?= ($opcao == $usuario['funcao']) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($opcao); ?>
                </option>
                <?php endforeach; ?>
            </select>


        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Senha: <p style="font-size: 13px; margin:0;">(deixe em branco para
                    manter a
                    senha
                    atual):</p></label>
            <input type="password" class="form-control" name="senha">
        </div>
        <div class="modal-footer">
            <form action="<?= INCLUDE_PATH;?>paineladmin" method="get">
                <button type="submit" class="btn btn-secondary mx-4">Voltar</button>
            </form>
            <button type="submit" class="btn btn-primary">Salvar alterações</button>
        </div>

    </form>




</section>