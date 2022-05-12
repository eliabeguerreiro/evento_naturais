<?php
session_start();
include_once './functions/conexao.php';


$select_id = "SELECT * FROM entradas WHERE id_cliente = ".$_GET['codigo']."";

//echo$select_id;
//echo("<br>");

$query_id = mysqli_query($conn, $select_id);



while($ingresso = mysqli_fetch_assoc($query_id)){

        
    $update_ingresso = "UPDATE entradas SET presente = 'sim' WHERE id_entradas = ".$ingresso['id_entradas']."";
    
    //echo$update_ingresso;

    $presenca = mysqli_query($conn, $update_ingresso);

    echo("Ingresso: ".$ingresso['codigo']." foi confirmado!");
    echo("<br>");

}


echo("<br><a href='index.php' type='button' >Voltar</a>");
