<?php

/*
$senha = 'jOkinh@a';
$senha_encriptada = password_hash($senha, PASSWORD_DEFAULT);
echo($senha_encriptada.'<br>');
*/

?>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Simposio Naturais</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="styles.css" rel="stylesheet">
    <link href="bootstrap.css" rel="stylesheet">
</head>

<body>
    <div class="circulo"></div>
    <main>
        <section class="glass">
                <div class="dashboard">
                    
                    <p>
                    <form method="POST" action="verifica.php">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Login</label>
                            <input type="usuario" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="usuario" placeholder="Digite seu login">
                           
                        <div class="form-group mt-4">
                            <label for="exampleInputPassword1">Senha</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="senha"
                                placeholder="Digite sua senha">
                            <br>
                        </div>
                        <button class="btn btn-primary" type="submit" name="btnLogin" value="acessar">Login</button>
                    </form>
                </div>
        </section>
    </main>
    <script src="//cdnjs.cloudflare.com/ajax/libs/min.js/0.2.3/$.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>
