<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="<?php echo INCLUDE_PATH_FULL?>css/style.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= self::titulo; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <header>
        <section class="d-flex justify-content-between align-items-center frete-gratis bg-dark text-white"
            data-bs-theme="dark">
            <h1 class="fs-6 fw-medium d-flex align-items-center gap-2 "><img src="<?= INCLUDE_IMAGES; ?>/box.png"
                    alt="...">Frete Grátis
                para
                todo o Brasil</h1>
            <div class="links-tops d-flex align-items-center gap-2">
                <a class="text-white" href="">Sobre</a>
                <a class="text-white" href="">Contato</a>
                <a class="text-white" href="">Central de ajuda</a>
            </div>
        </section>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand fw-bolder fs-3 titulo" href="#"><?= self::titulo; ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form class="d-flex  search-pesquisa" role="search">
                        <input class="form-control pesquisa-radius-left no-outline" type="search" placeholder="Buscar"
                            aria-label="Search">
                        <button
                            class="btn btn-outline-success bg-primary text-white pesquisa-radius-right pesquisar-btn d-flex align-items-center"
                            type="submit">
                            <img src="<?= INCLUDE_IMAGES; ?>/lupa.png" alt="...">
                            <img src="image/" alt="">
                        </button>
                    </form>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-1 text-black" aria-current="page"
                                href="<?= INCLUDE_PATH;?>login">
                                <img src="<?= INCLUDE_IMAGES; ?>/login.png" alt="...">
                                Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-1 text-black"
                                href="<?= INCLUDE_PATH;?>carrinho">
                                <img src="<?= INCLUDE_IMAGES; ?>/carrinho.png" alt="...">
                                Carrinho</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-1 text-black"
                                href="<?= INCLUDE_PATH;?>favoritos">
                                <img src="<?= INCLUDE_IMAGES; ?>/favorito.png" alt="...">
                                Favoritos</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <nav class="d-flex justify-content-between align-items-center menu">
            <ul class="navbar-nav d-flex flex-row gap-3">
                <?php 
                    foreach ($this->menuitens as $key => $value) {
                        echo '<li  class="nav-item"><a class="nav-link active" aria-current="page" href="'.INCLUDE_PATH.strtolower($value).'">'.$value.'</a></li>';
                    }
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Serviços
                    </a>
                    <ul class="dropdown-menu">
                        <?php 
                            foreach ($this->menudrop as $key => $value) {
                                echo '<li><a class="dropdown-item" href="'.INCLUDE_PATH.strtolower(str_replace(" ", "",$value)).'">'.$value.'</a></li>';
                            }
                        ?>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>