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

<body class="login-container">
    <section class="login">
        <a href="<?= INCLUDE_PATH;?>"><img class="logo" src="<?= INCLUDE_IMAGES; ?>/logo.png" alt="Repros"></a>
        <form action="" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" name="email" placeholder="E-mail" type="email" class="form-control"
                    aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <div class="input-password">
                    <input id="senha" name="senha" placeholder="Senha" type="password" class="form-control" required>
                    <button id="mostrarSenha" class="ver-ocultar-senha" type="button">
                        <img class="verocultar" src="<?= INCLUDE_IMAGES; ?>/ver-senha.png" alt="ver senha">
                    </button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary form-control" id="liveAlertBtn">Entrar</button>
        </form>
        <?php if (!empty($erro_login)): ?>
        <div class="alert alert-dismissible fade show alert-dark" role=" alert">
            <?= htmlspecialchars($erro_login); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <div class="links-login">
            <a class="text-center" href="<?= INCLUDE_PATH;?>esqueceuasenha">Esqueceu a senha?</a>
            <a class="text-center" href="<?= INCLUDE_PATH;?>criarConta">Não tem conta? Crie agora!</a>
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
            senhaInput.type = "text";
            imgVerOcultar.src = "<?= INCLUDE_IMAGES; ?>/oculta-senha.png";
        } else {
            senhaInput.type = "password";
            imgVerOcultar.src = "<?= INCLUDE_IMAGES; ?>/ver-senha.png";
        }
    });
    </script>
</body>

</html>