<?php
include_once './functions/conexao.php';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Perfil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="styles.css">
    <!-- Link Google Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>
</head>

<body>
    <center>
        <?php

?>
    </center>
    <div class='jumbotron'>
    <form method="POST" action="" enctype="multipart/form-data">

            <h3>Digite os dados que estão no cupon físcal.</h3>
            <br>
            <label>NR:</label>
            <input required class="form-control" type="number" name="NR_ECF">
            <br><br>
            <label>Caixa</label>
            <input required class="form-control" type="number" name="CD_CX">
            <br><br>
            <label>Loja</label>
            <input required class="form-control" type="number" name="CD_FILIAL">
            <br><br>
            
            <input required type="checkbox" id="scales" name="autorizo">
            <label>Autorizo o uso dos meus dados para fins comerciais e publicitários a terceiros nos termos da Política de Privacidade e da Lei 12.965/14.</label>
            
            <br><br><br>
            <input class="btn btn-primary" type="submit" name="cupon" value="Cadastrar"><br>

        </form>
    </div>
</body>
</html>


<?php


if($_POST){

    try{
        $Conexao = Conexao::getConnection();
                    

        //nome
        $query = $Conexao->query("SELECT * FROM PDV_VD WHERE NR_ECF = ".$_POST['NR_ECF']." AND CD_FILIAL = ".$_POST['CD_FILIAL']." AND CD_CX =".$_POST['CD_CX']."");
        $NOME = $query->fetchAll();

        

    }catch(Exception $e){
        echo $e->getMessage();

    }
    
}

