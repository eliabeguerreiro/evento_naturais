<?php

include_once './functions/conexao.php';



try{
    $Conexao = Conexao::getConnection();
                
    $query = $Conexao->query("
        SELECT  *
        FROM 
                V_EST_PROD_ARV_MERCADOLOGICA A INNER JOIN		
                EST_PROD_TBL_DESC_EST_ARV_MERC_LINHA G ON G.CD_ARV_MERC_LINHA = A.CD_ARV_MERC_LINHA
        
        WHERE 
            A.CD_PROD = 260 AND
            G.CD_TBL_DESC = 1256	
        ");

    $RESULTADO = $query->fetchAll();


}catch(Exception $e){
    echo $e->getMessage();

}

var_dump($RESULTADO);