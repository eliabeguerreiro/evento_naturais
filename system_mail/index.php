<?php
session_start();
include("./functions/conection.php");

if($_GET){

    $part = "SELECT * FROM participantes WHERE ID = ".$_GET['id']."";
    $participante = mysqli_query($conn, $part);

    $_SESSION['participante'] = mysqli_fetch_assoc($participante);


    $comp = "SELECT * FROM entradas WHERE id_cliente = ".$_GET['id']."";
    $comprovante = mysqli_query($conn, $comp);

    $_SESSION['comprovante'] = mysqli_fetch_assoc($comprovante);


    echo("<script>function redirect() {location.href='./sendEmail.php'}; redirect()</script>");
    
}else{

    echo("<script>function redirect() {location.href='https://10.7.0.211/evento_naturais/?erro=eixe'}; redirect()</script>");

}
?>
