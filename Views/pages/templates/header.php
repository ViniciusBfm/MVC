<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link href="<?php echo INCLUDE_PATH_FULL?>css/style.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= self::titulo; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Tabelas-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js">
    </script>
</head>

<body style="background-color: #e5eaee;">
    <header>
        <nav class="navbar navbar-expand-lg  sticky-top  bg-dark" data-bs-theme="dark">
            <div class=" container-fluid">
                <a class="navbar-brand fw-bold fs-3" href="<?= INCLUDE_PATH;?>solicitacao">REPROS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page"
                                href="<?= INCLUDE_PATH;?>solicitacao">Solicitação</a>
                        </li>
                        <?php if (isset($_SESSION['usuario_funcao']) && $_SESSION['usuario_funcao'] !== 'Professor'): ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="<?= INCLUDE_PATH;?>relatorios">Relatórios</a>
                        </li>
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Paineis
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= INCLUDE_PATH;?>paineladmin">Painel admin</a></li>
                                <li><a class="dropdown-item" href="<?= INCLUDE_PATH;?>painelreprografia">Painel da
                                        reprografia</a></li>
                                <li><a class="dropdown-item" href="<?= INCLUDE_PATH;?>painelsolicitacoes">Painel de
                                        solicitações
                                    </a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Bem vindo, <span class="fw-semibold"><?=$_SESSION['usuario_nome'];?></span>
                            </a>
                            <ul class="dropdown-menu w-100">

                                <li>
                                    <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        class="dropdown-item d-flex align-items-center gap-2" href="#"><img
                                            src="<?= INCLUDE_IMAGES; ?>/perfil.png" alt="">Meu perfil</a>
                                </li>

                                <li> <a href="<?= INCLUDE_LOGOUT;?>"
                                        class="d-flex align-items-center gap-2 dropdown-item">
                                        <img src="<?= INCLUDE_IMAGES; ?>/sair.png" alt="">Sair</a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Meu Perfil</h1>
                    <div data-bs-theme="dark" class="ms-auto">
                        <button type="button" data-bs-theme="dark" class="btn-close " data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="apresentacao-nome">
                        <p class="fs-5">Bem vindo, <span class="fw-medium"><?= $_SESSION['usuario_nome'];?></span>!</p>
                    </div>
                    <div class="edicao-infos">
                        <p class="fw-bold">Edite seus dados:</p>
                        <form action="index.php?url=updateprofile" method="POST">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome:</label>
                                <input type="text" class="form-control" id="nome" name="nome"
                                    value="<?= $_SESSION['usuario_nome'];?>">
                            </div>
                            <div class="mb-3">
                                <label for="matricula" class="form-label">N° matricula:
                                    <strong><?= $_SESSION['usuario_matricula'];?></strong></label>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail:</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?= $_SESSION['usuario_email'];?>">
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Altere sua senha:</label>
                                <input type="password" placeholder="Digite uma nova senha" class="form-control"
                                    id="senha" name="senha">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Salvar alterações</button>
                            </div>
                            <?php if (isset($_SESSION['error_message'])): ?>
                            <div class="alert alert-danger">
                                <?php 
                                    echo $_SESSION['error_message']; 
                                    unset($_SESSION['error_message']); // Limpa a mensagem depois de exibi-la
                                ?>
                            </div>
                            <?php endif; ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>