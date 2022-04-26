<?php
session_start();
include("./functions/conexao.php");

if($_SESSION['pagamento']){
  
    $pagamento = $_SESSION['pagamento'];
}else{
    
    $pagamento = "0";
}


if($_SESSION['quantidade']){
    ECHO(($_SESSION['quantidade']));
    
    
        $ing = "INSERT INTO entradas (id_cliente, user_vendedor, tipo, pagamento, cupom) VALUES  
        (".$_SESSION['id_cliente'].",".$_SESSION['usuario']['cd_loja'].",'".$_SESSION['tipo']."','".$pagamento."','".$_SESSION['cupom']."')";

    
        $ingre = mysqli_query($conn, $ing);
        $ingresso= mysqli_insert_id($conn);

        $_SESSION['quantidade']=-1;

          
    if($ingresso){

        $ig = ($_SESSION['usuario']['cd_loja']."000".$ingresso);

        $u = "UPDATE entradas SET codigo = '$ig' WHERE id_entradas = $ingresso";
        $upd = mysqli_query($conn, $u);

        if($upd){

            //header("Location: redepharma.com.br/email/index.php?id=$ig");
            echo("<script>function redirect() {location.href='https://www.conect.redepharma.com.br/email/index.php?id=$ingresso'}; redirect()</script>");
          
          
            echo("<br><h2>PARABÉNS!<h2><br>
            ESSE É O CÓDIGO DO SEU INGRESSO PARA O 1º SIMPÓSIO MULTIDISCIPLINAR FITNESS DA REDEPHARMA NATURAIS.<br>Número do Ingresso :".$ig."<br>");
        }

    }

    

}else{

    $ing = "INSERT INTO entradas (id_cliente, user_vendedor, tipo, cupom) VALUES  
        (".$_SESSION['id_cliente'].",".$_SESSION['usuario']['cd_loja'].",'".$_SESSION['tipo']."','".$_SESSION['cupom']."')";

        $ingre = mysqli_query($conn, $ing);
        $ingresso= mysqli_insert_id($conn);

        $_SESSION['quantidade']=-1;

        
    if($ingresso){

        $ig = ($_SESSION['usuario']['cd_loja']."000".$ingresso);

        $u = "UPDATE entradas SET codigo = '$ig' WHERE id_entradas = $ingresso";
        $upd = mysqli_query($conn, $u);

        if($upd){

            //header("Location: redepharma.com.br/email/index.php?id=$ingresso");

            echo("<script>function redirect() {location.href='https://www.conect.redepharma.com.br/email/index.php?id=$ingresso'}; redirect()</script>");
          
            echo("<br><h2>PARABÉNS!<h2><br>
            ESSE É O CÓDIGO DO SEU INGRESSO PARA O 1º SIMPÓSIO MULTIDISCIPLINAR FITNESS DA REDEPHARMA NATURAIS.<br>Número do Ingresso :".$ig."<br>");
        }

    }

}






