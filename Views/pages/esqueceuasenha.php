<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="<?php echo INCLUDE_PATH_FULL?>css/style.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= self::titulo.' - Esqueceu a senha'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="esqueceuasenha-container">
    <section class="esqueceuasenha">
        <form action="" method="post">
            <div class="criarconta-titulo text-center">
                <h4>Esqueceu sua senha?</h4>
            </div>
            <div class="text-center"><img class="img-criarconta" src="<?= INCLUDE_IMAGES; ?>/esqueceu.png" alt=""></div>
            <div class="esqueceuasenha-text">
                <p>Nós entendemos, coisas acontecem. Basta inserir seu <strong>e-mail</strong> abaixo e iremos redefinir
                    sua senha!</p>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" id="email" placeholder="Insira seu e-mail">
            </div>
            <button type="submit" class="btn btn-primary form-control">Enviar senha</button>
        </form>
        <div class="links-login">
            <a class="text-center" href="<?= INCLUDE_PATH;?>criarConta">Não tem conta? Crie agora!</a>
            <a class="text-center" href="<?= INCLUDE_PATH;?>">Já tem uma conta? Conecte-se</a>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>