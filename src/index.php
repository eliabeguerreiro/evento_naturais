<?php
session_start();
include_once './functions/conexao.php';


//var_dump($_SESSION);

if($_GET){
    if($_GET['modo']=='cupom'){
        $_SESSION['tipo'] = 'cupom';

        

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

                <div>

                        <a href="?modo=cupom">Verificar Cupom</a><br>
                        <a href="?modo=ingresso">Ingresso Vendido</a><br>

                        <?php
                            if($_SESSION['usuario']['tipo'] == 'admin'){

                                echo("<a href='?modo=cortesia'>Cortesia</a><br>");

                            }

                        ?>


                        

                </div>

            </center>
            <div class='jumbotron'>
            <form method="POST" action="" enctype="multipart/form-data">

                    <h3>Digite os dados que estão no cupom físcal.</h3>
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
                
                    <br>
                    <input class="btn btn-primary" type="submit" name="cupon" value="Cadastrar"><br>

                </form>
            </div>
        <br>
        </body>
        </html>


        <?php


        if($_POST){
        $total = 0;

            try{
                $Conexao = Conexao::getConnection();
                            

                //nome
                $query = $Conexao->query("SELECT CD_VD FROM PDV_VD WHERE NR_ECF = ".$_POST['NR_ECF']." AND CD_FILIAL = ".$_POST['CD_FILIAL']." AND CD_CX =".$_POST['CD_CX']."");
                $CUPON = $query->fetchAll();


            }catch(Exception $e){
                echo $e->getMessage();

            }

            try{
                $Conexao = Conexao::getConnection();
                            

                
                $query = $Conexao->query("SELECT CD_PROD FROM PDV_VD_IT WHERE CD_VD = ".$CUPON['0']['CD_VD']."");
                $VENDA = $query->fetchAll();

                

            }catch(Exception $e){
                echo $e->getMessage();

            }

            foreach($VENDA as $venda){

                
                //echo("produto vendido: ".$venda['0']);

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

                    //echo("Valor: ".$PRECO['0']['VLR_TABELA']);
                    $total += $PRECO['0']['VLR_TABELA'];

                }

                echo("<br>");
            }

            if($total >= 150){

                //echo("Valor atingido<br>");
                $_SESSION['cupom'] = $_POST['NR_ECF'];
                header("Location: cadastro.php");

            }else{

                echo("Valor não atingido<br>");
                

            }
                echo("Total de intens válidos R$:".$total);

        }






    }elseif($_GET['modo']=='ingresso'){
        $_SESSION['tipo'] = 'ingresso';

        if($_POST){

            $_SESSION['pagamento'] = $_POST['PAGAMENTO'];
            header("Location: cadastro.php");


        }
        

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
    
                <div>
    
                        <a href="?modo=cupom">Verificar Cupom</a><br>
                        <a href="?modo=ingresso">Ingresso Vendido</a><br>
                        <?php
                            if($_SESSION['usuario']['tipo'] == 'admin'){

                                echo("<a href='?modo=cortesia'>Cortesia</a><br>");

                            }

                        ?>

    
                </div>
    
            
            <div class='jumbotron'>
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
                    <input class="btn btn-primary" type="submit" name="ingresso" value="Cadastrar"><br>

                </form>
            </div>
        <br>
        </center>
        </body>
        </html>


        <?php
    
    

        //loja, forma de pagamente, 


    }elseif($_GET['modo']=='cortesia'){
        $_SESSION['tipo'] = 'cortesia';

        header("Location: cadastro.php?modo=cortesia");

    }


}else{

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

            <div>

                    <a href="?modo=cupom">Verificar Cupom</a><br>
                    <a href="?modo=ingresso">Ingresso Vendido</a><br>
                    <?php
                            if($_SESSION['usuario']['tipo'] == 'admin'){

                                echo("<a href='?modo=cortesia'>Cortesia</a><br>");

                            }

                        ?>


            </div>

        </center>


    </body>
    </html>


<?php

}