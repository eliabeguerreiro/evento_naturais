<?php
include_once './functions/conexao.php';

try{
    $Conexao = Conexao::getConnection();
                
    $query = $Conexao->query("
    SELECT * FROM ARVORE_RAPPI ORDER BY CD_PROD ASC
    OPTION(maxrecursion 0)
        ");

    $query2 = $Conexao->query("
    TRUNCATE TABLE EST_PROD_PRECO_DELIVERY
        ");
    

    $RESULTADO = $query->fetchAll();


}catch(Exception $e){
    echo $e->getMessage();

}


foreach($RESULTADO as $result){


    try{
        $Conexao = Conexao::getConnection();
                    
        $query = $Conexao->query("
            INSERT INTO EST_PROD_PRECO_DELIVERY (CD_PROD, CD_FILIAL, VLR_DELIVERY, TP_DESCONTO) VALUES (".$result['CD_PROD'].", 10, 0, 'NULL')");
    
        $LINHA = $query->fetchAll();
    
    
    }catch(Exception $e){
        echo $e->getMessage();
    
    }
    echo("<br>");
    echo$result['CD_PROD'];
    //fim do foreach

}


echo("<h1>DESCONTOS ATUALIZADOS!</h1>");