<?php
session_start();
include("./functions/conexao.php");

if($_SESSION['pagamento']){
  
    $pagamento = $_SESSION['pagamento'];
}else{
    
    $pagamento = "0";
}

    

$ing = "INSERT INTO entradas (id_cliente, user_vendedor, tipo, pagamento) VALUES  

(".$_SESSION['id_cliente'].",".$_SESSION['usuario']['cd_loja'].",'".$_SESSION['tipo']."','".$pagamento."')";
$ingre = mysqli_query($conn, $ing);
$ingresso= mysqli_insert_id($conn);


if($ingresso){

    $ig = ($_SESSION['usuario']['cd_loja']."000".$ingresso);

    $u = "UPDATE entradas SET codigo = '$ig' WHERE id_entradas = $ingresso";
    $upd = mysqli_query($conn, $u);

    if($upd){

       
    
        echo("<br>Número do Ingresso :".$ig);
    
    
    }

}


