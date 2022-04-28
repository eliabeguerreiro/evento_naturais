<?php
session_start();


if($_GET){

    $_SESSION['ID'] = $_GET['id'];

    echo("<script>function redirect() {location.href='./sendEmail.php'}; redirect()</script>");
    
}else{

    echo("<script>function redirect() {location.href='https://10.7.0.211/evento_naturais/?erro=eixe'}; redirect()</script>");

}
?>
