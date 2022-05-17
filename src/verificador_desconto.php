<?php

include_once './functions/conexao.php';



try{
    $Conexao = Conexao::getConnection();
                
    $query = $Conexao->query("
    SELECT * FROM ARVORE_RAPPI
    OPTION(maxrecursion 0)
        ");

    $RESULTADO = $query->fetchAll();


}catch(Exception $e){
    echo $e->getMessage();

}

//var_dump($RESULTADO);


//SELECT * FROM EST_PROD_TBL_DESC_EST_PROD WHERE EST_PROD= 3002 and CD_TBL_DESC = 1256

foreach($RESULTADO as $result){




    
try{
    $Conexao = Conexao::getConnection();
                
    $query = $Conexao->query("
        SELECT PERC_DESC FROM EST_PROD_TBL_DESC_EST_PROD WHERE CD_PROD = ".$result['CD_PROD']." and CD_TBL_DESC = 1256
        ");

    $PRODUTO = $query->fetchAll();


}catch(Exception $e){
    echo $e->getMessage();

}


try{
    $Conexao = Conexao::getConnection();
                
    $query = $Conexao->query("
        SELECT PERC_DESC FROM EST_PROD_TBL_DESC_EST_ARV_MERC_FAMILIA WHERE CD_ARV_MERC_FAMILIA = ".$result['CD_ARV_MERC_FAMILIA']." and CD_TBL_DESC = 1256
        ");

    $FAMILIA = $query->fetchAll();


}catch(Exception $e){
    echo $e->getMessage();

}

try{
    $Conexao = Conexao::getConnection();
                
    $query = $Conexao->query("
        SELECT PERC_DESC FROM EST_PROD_TBL_DESC_EST_MC WHERE CD_MC = ".$result['CD_MC']." and CD_TBL_DESC = 1256
        ");

    $MARCA = $query->fetchAll();


}catch(Exception $e){
    echo $e->getMessage();

}

try{
    $Conexao = Conexao::getConnection();
                
    $query = $Conexao->query("
        SELECT PERC_DESC FROM EST_PROD_TBL_DESC_EST_PROD_FABRIC WHERE CD_FABRIC = ".$result['CD_FABRIC']." and CD_TBL_DESC = 1256
        ");

    $FABRICANTE = $query->fetchAll();


}catch(Exception $e){
    echo $e->getMessage();

}

try{
    $Conexao = Conexao::getConnection();
                
    $query = $Conexao->query("
        SELECT PERC_DESC FROM EST_PROD_TBL_DESC_EST_ARV_MERC_CATEGORIA WHERE CD_ARV_MERC_CATEG = ".$result['CD_ARV_MERC_CATEG']." and CD_TBL_DESC = 1256
        ");

    $CATEGORIA = $query->fetchAll();


}catch(Exception $e){
    echo $e->getMessage();

}

try{
    $Conexao = Conexao::getConnection();
                
    $query = $Conexao->query("
        SELECT PERC_DESC FROM EST_PROD_TBL_DESC_EST_ARV_MERC_LINHA WHERE CD_ARV_MERC_LINHA = ".$result['CD_ARV_MERC_LINHA']." and CD_TBL_DESC = 1256
        ");

    $LINHA = $query->fetchAll();


}catch(Exception $e){
    echo $e->getMessage();

}

    echo("<br>CD_PROD: ");
    echo($result['CD_PROD']);
    echo("<br>");
    var_dump($PRODUTO);

    echo("<br>CD_ARV_MERC_FAMILIA: ");
    echo($result['CD_ARV_MERC_FAMILIA']);
    echo("<br>");
    var_dump($FAMILIA);

    echo("<br>CD_MC: ");
    echo($result['CD_MC']);
    echo("<br>");
    var_dump($MARCA);

    echo("<br>CD_FABRIC: ");
    echo($result['CD_FABRIC']);
    echo("<br>");
    var_dump($FABRICANTE);

    echo("<br>CD_ARV_MERC_CATEG: ");
    echo($result['CD_ARV_MERC_CATEG']);
    echo("<br>");
    var_dump($CATEGORIA);

    echo("<br>CD_ARV_MERC_LINHA: ");
    echo($result['CD_ARV_MERC_LINHA']);
    echo("<br>");
    var_dump($LINHA);

    echo("<br>");


}