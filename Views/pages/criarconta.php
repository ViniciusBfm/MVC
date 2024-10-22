<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= self::titulo.' - Criar conta'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="<?php echo INCLUDE_PATH_FULL?>css/style.css" rel="stylesheet" type="text/css">
</head>

<body class="criarconta-container">
    <section class="criarconta">
        <div class="criarconta-box">
            <div class="criarconta-titulo text-center">
                <h4>Vamos criar sua conta?</h4>
            </div>
            <form class="form-criarconta" action="" method="post">
                <div id="carouselExampleIndicators" class="carousel slide carousel-dark carousel-criarconta">
                    <div class="carousel-inner">
                        <?php if (!empty($erro_criarconta)): ?>
                        <div class="alert alert-danger text-center">
                            <?= htmlspecialchars($erro_criarconta); ?>
                        </div>
                        <?php endif; ?>
                        <div class="carousel-item active">
                            <div class="d-block w-100">
                                <div class="text-center">
                                    <img class="img-criarconta" src="<?= INCLUDE_IMAGES; ?>/cc-part0.png" alt="">
                                    <p>Olá, qual o seu nome?</p>
                                </div>
                                <input type="text" name="nome" value="<?= htmlspecialchars($nome ?? ''); ?>"
                                    placeholder="Digite seu nome e sobrenome" class="form-control" id="nome" required>
                                <button id="nextButton" style="height: 50px;" class="btn btn-primary w-100"
                                    type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide="next">Próximo</button>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-block w-100">
                                <div class="text-center">
                                    <img class="img-criarconta" src="<?= INCLUDE_IMAGES; ?>/cc-part5.png" alt="">
                                    <p>Qual número da sua matrícula?</p>
                                </div>
                                <input type="number" name="matricula" value="<?= htmlspecialchars($matricula ?? ''); ?>"
                                    class="form-control" id="matricula" placeholder="N° da matrícula" required>
                                <button id="nextButton" style="height: 50px;" class="btn btn-primary w-100"
                                    type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide="next">Próximo</button>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-block w-100">
                                <div class="text-center">
                                    <img class="img-criarconta" src="<?= INCLUDE_IMAGES; ?>/cc-part1.png" alt="">
                                    <p>Qual e-mail você deseja cadastrar?</p>
                                </div>
                                <input type="email" name="email" value="<?= htmlspecialchars($email ?? ''); ?>"
                                    class="form-control" id="email" placeholder="Digite e-mail para cadastro" required>
                                <button id="nextButton" style="height: 50px;" class="btn btn-primary w-100"
                                    type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide="next">Próximo</button>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-block w-100">
                                <div class="text-center">
                                    <img class="img-criarconta" src="<?= INCLUDE_IMAGES; ?>/cc-part5.png" alt="">
                                    <p>Qual a sua função? Selecione aqui:</p>
                                </div>
                                <select style="height: 50px;" name="funcao" id="funcao" class="form-control form-select"
                                    required>
                                    <option value="" disabled <?= empty($funcao) ? 'selected' : ''; ?>>Selecione sua
                                        função</option>
                                    <?php foreach ($opcoes_funcao as $opcao): ?>
                                    <option value="<?= htmlspecialchars($opcao); ?>"
                                        <?= (isset($funcao) && $opcao === $funcao) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($opcao); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <button id="nextButton" style="height: 50px;" class="btn btn-primary w-100"
                                    type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide="next">Próximo</button>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-block w-100">
                                <div class="text-center">
                                    <img class="img-criarconta" src="<?= INCLUDE_IMAGES; ?>/cc-part2.png" alt="">
                                    <p>Escolha uma senha forte e segura:</p>
                                </div>
                                <div class="input-password">
                                    <input id="senha" name="senha" placeholder="Senha" type="password"
                                        class="form-control" required>
                                    <button id="mostrarSenha" class="ver-ocultar-senha" type="button">
                                        <img class="verocultar" src="<?= INCLUDE_IMAGES; ?>/ver-senha.png"
                                            alt="ver senha">
                                    </button>
                                </div>
                                <button style="height: 50px;" type="submit"
                                    class="btn-criar btn btn-primary form-control">Criar conta
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="text-center buttons-slide carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                            aria-label="Slide 4"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"
                            aria-label="Slide 5"></button>
                    </div>
                </div>
            </form>




            <div class="links-login">
                <a class="text-center" href="<?= INCLUDE_PATH;?>">Já tem uma conta? Conecte-se</a>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
    document.getElementById("mostrarSenha").addEventListener("click", function() {
        var senhaInput = document.getElementById("senha");
        var imgVerOcultar = document.querySelector(".verocultar");

        if (senhaInput.type === "password") {
            senhaInput.type = "email";
            imgVerOcultar.src = "<?= INCLUDE_IMAGES; ?>/oculta-senha.png";
        } else {
            senhaInput.type = "password";
            imgVerOcultar.src = "<?= INCLUDE_IMAGES; ?>/ver-senha.png";
        }
    });
    </script>

</body>

</html>