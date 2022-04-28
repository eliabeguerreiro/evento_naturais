<?php
session_start();
include_once './functions/conexao.php';





if($_GET){
    if($_GET['modo']=='cupom'){
        $_SESSION['tipo'] = 'cupom';

        
        $count ="count(*)";
        $to = "SELECT $count FROM entradas";

        $tot = mysqli_query($conn, $to);
        $total = mysqli_fetch_assoc($tot);

        
        ?>

        <!DOCTYPE html>
        <html lang="pt-br">

        <head>
            <title>Cupom</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- Bootstrap CSS CDN -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
                integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
            <!-- Our Custom CSS -->
            <link rel="stylesheet" href="./css/style.css">
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
                <main class="back">
                <div class="header">
                <img height="65px" width="auto" src="../images/softLogo.png" alt="Logo">
                <div style="display: flex; font-size: 20px;">

                <a style="margin-right: 15px; color: #fff;" href="?modo=cupom">Verificar Cupom</a><br>
                
                <!--a href="?modo=ingresso">Ingresso Vendido</a><br-->

                <?php
                    if($_SESSION['usuario']['tipo'] == 'admin'){

                        echo("<a style='color: #fff; margin-right: 15px;' href='?modo=cortesia'>Cotesia </a><br>");
                        echo("<a style='color:  #fff; margin-right: 15px;' href='?modo=dashboard'>Dashboard </a><br>");
                        
                    }
                    //var_dump($_SESSION);

                ?>

                </div>
                <div class="ingressos">
                    <?php
                        if($_SESSION['usuario']['tipo'] == 'admin'){
                            echo("Ingressos disponiveis: ");
                            echo(685 - $total['count(*)']);
                        }
                    ?>
                </div>
                </div>
                    <section class="dashboard">

                        <div style="background-color: #b0bd6d; padding: 50px 70px 50px 70px; border-radius: 15px; border-width: 2px; border-style: solid; border-color: #748535">
                            <form method="POST" action="" enctype="multipart/form-data">
                                
                                <h3 style="color: #fff">Digite os dados que estão no cupom físcal.</h3>
                                <br>
                                <label style="color: #fff">NR:</label>
                                <input required class="form-control" type="number" name="NR_ECF">
                                <br><br>
                                <label style="color: #fff">Caixa</label>
                                <input required class="form-control" type="number" name="CD_CX">
                                <br><br>
                                <label style="color: #fff">Loja</label>
                                <input required class="form-control" type="number" name="CD_FILIAL">
                                <br><br>
                                
                                <br>
                                <input class="btn btn-success" type="submit" name="cupon" value="Cadastrar"><br>
                                
                            </form>
                        </div>
                        <br>
                    </section>
                </main>
            </center>
            </body>
            </html>
            
            
            <?php


        if($_POST){
            $total = 0;

            $ver = "SELECT * FROM entradas WHERE cupom = '".$_POST['NR_ECF']."'";
            $veri = mysqli_query($conn, $ver);
            $verify = mysqli_num_rows($veri);

            if($verify != 0){

                
                echo("Esse cupom já foi utilizado!<br>");

            }else{
                
                try{
                    $Conexao = Conexao::getConnection();
                                
                    $query = $Conexao->query("SELECT CD_VD FROM PDV_VD WHERE NR_ECF = ".$_POST['NR_ECF']." AND CD_FILIAL = ".$_POST['CD_FILIAL']." AND CD_CX =".$_POST['CD_CX']."");
                    $CUPON = $query->fetchAll();


                }catch(Exception $e){
                    echo $e->getMessage();

                }

                try{
                    $Conexao = Conexao::getConnection();

                    $query = $Conexao->query("SELECT CD_PROD, QT_IT FROM PDV_VD_IT WHERE CD_VD = ".$CUPON['0']['CD_VD']."");
                    $VENDA = $query->fetchAll();

    
                }catch(Exception $e){
                    echo $e->getMessage();

                }

                foreach($VENDA as $venda){

                    try{
                        $Conexao = Conexao::getConnection();
                                    
                        $query = $Conexao->query("SELECT CD_PROD FROM EST_PROD WHERE CD_PROD = ".$venda['0']." AND CD_FABRIC = 327 ");
                        $PRODUTOS_VALIDOS = $query->fetchAll();
                
                        
                    }catch(Exception $e){
                        echo $e->getMessage();
            
                    }

                    foreach($PRODUTOS_VALIDOS as $prod_valido){
                        //echo("<br>Produto válido: ".$prod_valido['0']."<br>");

                        try{
                            $Conexao = Conexao::getConnection();
                                        
                    
                            
                            $query = $Conexao->query("SELECT VLR_TABELA FROM EST_PROD_PRECO WHERE CD_PROD = ".$prod_valido['0']." AND CD_FILIAL = ".$_POST['CD_FILIAL']."");
                            $PRECO = $query->fetchAll();
                    
                            
                    
                        }catch(Exception $e){
                            echo $e->getMessage();
                    
                        }                        
                    }     
                }


                $_SESSION['qtd'] = $VENDA['0']['QT_IT'];
                $total = $_SESSION['preco'] * $_SESSION['qtd'];
                $total /= 150;
                $_SESSION['quantidade'] = number_format($total, 0, '.', '');

                header("Location: cadastro.php");
            
           }

            //fim do if POST
        }


    }elseif($_GET['modo']=='ingresso'){
        $_SESSION['tipo'] = 'ingresso';

        if($_POST){

            $_SESSION['pagamento'] = $_POST['PAGAMENTO'];
            header("Location: cadastro.php");


        }
        
        $count ="count(*)";
        $to = "SELECT $count FROM entradas";

        $tot = mysqli_query($conn, $to);
        $total = mysqli_fetch_assoc($tot);

        ?>
        <!DOCTYPE html>
        <html lang="pt-br">
    
        <head>
            <title>Ingresso comprado</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- Bootstrap CSS CDN -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
                integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
            <!-- Our Custom CSS -->
            <link rel="stylesheet" href="./css/style.css">
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
            <main class="back">
            <div class="header">
                <img height="65px" width="auto" src="../images/softLogo.png" alt="Logo">
                <div style="display: flex; font-size: 20px;">

                <a style="margin-right: 15px; color: #fff;" href="?modo=cupom">Verificar Cupom</a><br>
                <!--a href="?modo=ingresso">Ingresso Vendido</a><br-->

                <?php
                    if($_SESSION['usuario']['tipo'] == 'admin'){

                        echo("<a style='color: #fff; margin-right: 15px;' href='?modo=cortesia'>Cotesia </a><br>");
                        echo("<a style='color:  #fff; margin-right: 15px;' href='?modo=dashboard'>Dashboard </a><br>");
                        

                    }

                ?>

                </div>
                <div class="ingressos">
                    <?php
                        if($_SESSION['usuario']['tipo'] == 'admin'){
                            echo("Ingressos disponiveis: ");
                            echo(685 - $total['count(*)']);
                        }
                    ?>
                </div>
                </div>
                    <section class="dashboard">
    
            
            <div style="background-color: #b0bd6d; padding: 50px 70px 50px 70px; border-radius: 15px; border-width: 2px; border-style: solid; border-color: #748535">
            <form method="POST" action="" enctype="multipart/form-data">

            <h3><label for="endereco">Selecione a forma de pagamento</label></h3>
    
            <div class="col-md-4">
                

                <select class="form-control" name="PAGAMENTO" id="">
                    <option value="">selecione</option>
                    <option value="debito">Debito</option>
                    <option value="credito">Credito</option>
                    <option value="dinheiro">Dinheiro</option>
                    <option value="pix">PIX</option>
                    <option value="transferencia">Tranferencia</option>
                    
                </select><br><br>   
                                    
                </div>

                    <br>
                    <input class="btn btn-success" type="submit" name="ingresso" value="Cadastrar"><br>

                </form>
            </div>
        <br>
    </main>
</section>
</center>
        </body>
        </html>


        <?php
    
    

        //loja, forma de pagamente, 


    }elseif($_GET['modo']=='cortesia'){
        $_SESSION['tipo'] = 'cortesia';

        header("Location: cadastro.php?modo=cortesia");

    }elseif($_GET['modo']=='dashboard'){
          
        header("Location: entradas.php");

    }



}else{

    $count ="count(*)";
    $to = "SELECT $count FROM entradas";

    $tot = mysqli_query($conn, $to);
    $total = mysqli_fetch_assoc($tot);

    ?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <title>Verificador</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
            integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="./css/style.css">
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
        <main class="back">
        <div class="header">
                <img height="65px" width="auto" src="../images/softLogo.png" alt="Logo">
                <div style="display: flex; font-size: 20px;">

                <a style="margin-right: 15px; color: #fff;" href="?modo=cupom">Verificar Cupom</a><br>
                <!--a href="?modo=ingresso">Ingresso Vendido</a><br-->

                <?php
                    if($_SESSION['usuario']['tipo'] == 'admin'){

                        echo("<a style='color: #fff; margin-right: 15px;' href='?modo=cortesia'>Cotesia </a><br>");
                        echo("<a style='color:  #fff; margin-right: 15px;' href='?modo=dashboard'>Dashboard </a><br>");
                        

                    }

                ?>

                </div>
                <div class="ingressos">
                    <?php
                        if($_SESSION['usuario']['tipo'] == 'admin'){
                            echo("Ingressos disponiveis: ");
                            echo(685 - $total['count(*)']);
                        }
                    ?>
                </div>
                </div>
                    <section class="dashboard">

                    </main>
                </section>
                </center>

    </body>
    </html>


<?php

}

var_dump($_SESSION);