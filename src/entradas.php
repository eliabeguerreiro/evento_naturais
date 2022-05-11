<?php
session_start();
include_once './functions/conexao.php';

$count ="count(*)";
        $to = "SELECT $count FROM entradas";

        $tot = mysqli_query($conn, $to);
        $total = mysqli_fetch_assoc($tot);
        $pesquisa = (!empty($_GET['pesquisa'])) ? $pesquisa : 'no';
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <title>Dashboard - Simpósio Naturais</title>
</head>
<body>
    <center>
<main class="back" style="padding: 120px 0 30px 0;">
<div class="header">
                <img onclick="location.href='./'" height="65px" width="auto" src="../images/softLogo.png" alt="Logo">
                <div style="display: flex; font-size: 20px;">

                <a style="margin-right: 15px; color: #fff;" href="?modo=cupom">Verificar Cupom</a><br>
                <!--a href="?modo=ingresso">Ingresso Vendido</a><br-->

                <?php
                    if($_SESSION['usuario']['tipo'] == 'admin'){

                        echo("<a style='color: #fff; margin-right: 15px;' href='index.php?modo=cortesia'>Cortesia </a><br>");
                        echo("<a style='color:  #fff; margin-right: 15px;' href='?modo=dashboard'>Dashboard </a><br>");
                        

                    }

                ?>
                <div class="ingressos">
                    <?php
                        if($_SESSION['usuario']['tipo'] == 'admin'){
                            echo("Ingressos disponiveis: ");
                            echo(685 - $total['count(*)']);
                        }
                    ?>
                </div>

                </div>
                
                </div>
                <div class="search">
                    <form method="GET" action="" id="searchbar">
            <label for="pesquisa">Nome / CPF / E-mail:</label>
        
            <input name='pesquisa' type="search" placeholder="Procurar...">
            <div onclick="document.getElementById('searchbar').submit()">
                <i class="fas fa-search"></i>
            </div>
            
        </form>
    </div>
        <div style="width: 97%">
            <div class="recentInbox">
            <?php
            if($_GET){
                echo('<div class="cardHeader">
                <h3>Resultado da pesquisa</h3>
            </div>');
            }else{
                echo('<div class="cardHeader">
                <h3>Todos os ingressos</h3>
            </div>');
            }
            ?>
            <table id='customers'>
           
                <?php
                

                if($pesquisa != "no"){
                    $select_cliente = "SELECT * FROM participantes WHERE NOME like '%".$_GET['pesquisa']."%' OR CPF like '%".$_GET['pesquisa']."%' OR EMAIL like '%".$_GET['pesquisa']."%' ";
                
                    ?>
                    <thead>
                        <tr>

                            <td>Número do ingresso</td>   
                            <td>Nome</td>
                            <td>CPF</td>
                            <td>Tipo</td>
                            <td>Telefone</td>
                            <td>E-mail</td>
                            
                        </tr>
                        
                    </thead>
                    <tbody>
                                
                    <?php
    
    $query_cliente = mysqli_query($conn, $select_cliente);
    
    while($cliente = mysqli_fetch_assoc($query_cliente)){
        
        
        $select_ingresso = "SELECT * FROM entradas WHERE id_cliente = '".$cliente['ID']."' ORDER BY id_entradas DESC";
                        $query_ingresso = mysqli_query($conn, $select_ingresso);
                        $ingressos = mysqli_fetch_assoc($query_ingresso);
    
                            
                            echo("
        
                            <tr>
                                <td>".$ingressos['codigo']."</td>
                                <td>".$cliente['NOME']."</td>
                                <td>".$cliente['CPF']."</td>
                                <td>".$ingressos['tipo']."</td>
                                <td>".$cliente['NUMERO']."</td>
                                <td>".$cliente['EMAIL']."</td>
                                <!--td> <a href='#' type='button' class='btn btn-primary'>Confirmar Presença</a></td-->
                            </tr>
        
                            ");
                    }
    
                }else{
    
                    $select_ingresso = "SELECT * FROM entradas ORDER BY id_entradas DESC";
                    $query_ingresso = mysqli_query($conn, $select_ingresso);
    
                    ?>
                        <thead>
                            <tr>
        
                                <td>Número do ingresso</td>   
                                <td>Nome</td>
                                <td>CPF</td>
                                <td>Tipo</td>
                                <td>Telefone</td>
                                <td>E-mail</td>
                            
                                
                            </tr>
                            
                        </thead>
                        
                        <tbody>
                            
                            
                            <?php
    
    
    while($ingressos = mysqli_fetch_assoc($query_ingresso)){
        $select_cliente = "SELECT * FROM participantes WHERE ID = '".$ingressos['id_cliente']."'";
                    $query_cliente = mysqli_query($conn, $select_cliente);
                    $cliente = mysqli_fetch_assoc($query_cliente);
                    
                    
                    echo("
                    
                    <tr>
                        <td>".$ingressos['codigo']."</td>
                        <td>".$cliente['NOME']."</td>
                        <td>".$cliente['CPF']."</td>
                        <td>".$ingressos['tipo']."</td>
                        <td>".$cliente['NUMERO']."</td>
                        <td>".$cliente['EMAIL']."</td>
                        <!--td> <a href='#' type='button' class='btn btn-primary'>Confirmar Presença</a></td-->
                    </tr>
                    
                    ");
                }
                
            }
            
            ?>
    
</tbody>

</table>
</div>
</div>
</main>
</center>
</body>
</html>