<?php

/*
$senha = 'jOkinh@a';
$senha_encriptada = password_hash($senha, PASSWORD_DEFAULT);
echo($senha_encriptada);
*/

?>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Simposio Naturais</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main>
        <section class="back">
                <div class="dashboard">
                    <center><img src="./images/logo.png" alt="LogoNaturais" width="200px" style="margin-bottom: 30px"></center>
                    <form method="POST" action="verifica.php">
                        <div class="label-input">
                            <label for="exampleInputEmail1">Login</label>
                            <input required type="usuario" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="usuario" placeholder="Digite seu login">
                        <div class="label-input">
                            <label for="exampleInputPassword1">Senha</label>
                            <input required type="password" class="form-control" id="exampleInputPassword1" name="senha"
                                placeholder="Digite sua senha">
                            <br>
                        </div>
                        <div class="btn-area">
                            <button class="btn btn-success" type="submit" name="btnLogin" value="acessar">Login</button>
                        </div>
                    </form>
                </div>
        </section>
    </main>
</body>

</html>
