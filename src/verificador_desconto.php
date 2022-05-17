<?php

include_once './functions/conexao.php';



try{
    $Conexao = Conexao::getConnection();
                
    $query = $Conexao->query("
        SELECT
                A.CD_PROD, 
                A.CD_ARV_MERC_FAMILIA,
                A.CD_MC,
                A.CD_FABRIC,
                A.CD_ARV_MERC_CATEG,
                A.CD_ARV_MERC_LINHA
                
        FROM 
                V_EST_PROD_ARV_MERCADOLOGICA A 
        
        WHERE 
            A.CD_PROD = 260 
        ");

    $RESULTADO = $query->fetchAll();


}catch(Exception $e){
    echo $e->getMessage();

}

//var_dump($RESULTADO);

foreach($RESULTADO as $result){

    echo("<br>CD_PROD: ");
    echo($result['CD_PROD']);

    echo("<br>CD_ARV_MERC_FAMILIA: ");
    echo($result['CD_ARV_MERC_FAMILIA']);

    echo("<br>CD_MC: ");
    echo($result['CD_MC']);

    echo("<br>CD_FABRIC: ");
    echo($result['CD_FABRIC']);

    echo("<br>CD_ARV_MERC_CATEG: ");
    echo($result['CD_ARV_MERC_CATEG']);

    echo("<br>CD_ARV_MERC_LINHA: ");
    echo($result['CD_ARV_MERC_LINHA']);

    echo("<br>");


}