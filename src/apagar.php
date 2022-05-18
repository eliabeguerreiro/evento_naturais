<?php



if(!isset($LINHA[0][0])){
//inicio linha 
    
    if(!isset($CATEGORIA[0][0])){
        //inicio categoria 
        
        if(!isset($FABRICANTE[0][0])){
            //inicio fabricante
            
            if(!isset($MARCA[0][0])){
                //inicio marca
                
                if(!isset($FAMILIA[0][0])){
                    //inicio familia
                    
                    if(!isset($PRODUTO[0][0])){
                        //não há desconto                    
                            
                    }else{
                    //se tive desconto no produtos
                        $dividendo = (round($PRODUTO[0][0], 1));
                        $divisor = (round($valor_tabela, 1));
                    
                        $resultado = ($divisor / $dividendo);
                        $novo_preco = ($valor_tabela-$resultado);
                    
                        try{
                            $Conexao = Conexao::getConnection();
                    
                            $query = $Conexao->query("
                            UPDATE EST_PROD_PRECO_DELIVERY SET VLR_DELIVERY = $novo_preco WHERE CD_PROD = ".$result['CD_PROD']."");
                            $query2 = $Conexao->query("
                            UPDATE EST_PROD_PRECO_DELIVERY SET TP_DESCONTO = 'CD_PROD' WHERE CD_PROD = ".$result['CD_PROD']."");
                    
                            $UPDATE1 = $query->fetchAll();
                            $UPDATE2 = $query2->fetchAll();
                    
                        }catch(Exception $e){
                            echo $e->getMessage();
                            echo("<br>");
                        }
                    
                        }
                    
                    }else{    
                    //se tiver desconto na familia
                        
                        $dividendo = (round($FAMILIA[0][0], 1));
                        $divisor = (round($valor_tabela, 1));
                    
                    
                        $resultado = ($divisor / $dividendo);
                        $novo_preco = ($valor_tabela-$resultado);
                    
                        try{
                            $Conexao = Conexao::getConnection();
                    
                            $query = $Conexao->query("
                            UPDATE EST_PROD_PRECO_DELIVERY SET VLR_DELIVERY = $novo_preco WHERE CD_PROD = ".$result['CD_PROD']."");
                            $query2 = $Conexao->query("
                            UPDATE EST_PROD_PRECO_DELIVERY SET TP_DESCONTO = 'CD_ARV_MERC_FAMILIA' WHERE CD_PROD = ".$result['CD_PROD']."");
                    
                            $UPDATE1 = $query->fetchAll();
                            $UPDATE2 = $query2->fetchAll();
                    
                        }catch(Exception $e){
                            echo $e->getMessage();
                            echo("<br>");
                        }
                    
                    }
                
                }else{
                //se tiver desconto na marca
                
                    $dividendo = (round($MARCA[0][0], 1));
                    $divisor = (round($valor_tabela, 1));
                
                
                    $resultado = ($divisor / $dividendo);
                    $novo_preco = ($valor_tabela-$resultado);
                
                    try{
                        $Conexao = Conexao::getConnection();
                
                        $query = $Conexao->query("
                        UPDATE EST_PROD_PRECO_DELIVERY SET VLR_DELIVERY = $novo_preco WHERE CD_PROD = ".$result['CD_PROD']."");
                        $query2 = $Conexao->query("
                        UPDATE EST_PROD_PRECO_DELIVERY SET TP_DESCONTO = 'CD_MC' WHERE CD_PROD = ".$result['CD_PROD']."");
                
                        $UPDATE1 = $query->fetchAll();
                        $UPDATE2 = $query2->fetchAll();
                
                    }catch(Exception $e){
                        echo $e->getMessage();
                        echo("<br>");
                    }
                
                }
                
            }else{
            //se tiver desconto no fabricante
            
                $dividendo = (round($FABRICANTE[0][0], 1));
                $divisor = (round($valor_tabela, 1));
            
            
                $resultado = ($divisor / $dividendo);
                $novo_preco = ($valor_tabela-$resultado);
            
                try{
                    $Conexao = Conexao::getConnection();
            
                    $query = $Conexao->query("
                    UPDATE EST_PROD_PRECO_DELIVERY SET VLR_DELIVERY = $novo_preco WHERE CD_PROD = ".$result['CD_PROD']."");
                    $query2 = $Conexao->query("
                    UPDATE EST_PROD_PRECO_DELIVERY SET TP_DESCONTO = 'CD_FABRIC' WHERE CD_PROD = ".$result['CD_PROD']."");
            
                    $UPDATE1 = $query->fetchAll();
                    $UPDATE2 = $query2->fetchAll();
            
                }catch(Exception $e){
                    echo $e->getMessage();
                    echo("<br>");
                }
            }           
        
    }else{
    //se tiver desconto na categoria
        
        $dividendo = (round($CATEGORIA[0][0], 1));
        $divisor = (round($valor_tabela, 1));
    
    
        $resultado = ($divisor / $dividendo);
        $novo_preco = ($valor_tabela-$resultado);
    
        try{
            $Conexao = Conexao::getConnection();
    
            $query = $Conexao->query("
            UPDATE EST_PROD_PRECO_DELIVERY SET VLR_DELIVERY = $novo_preco WHERE CD_PROD = ".$result['CD_PROD']."");
            $query2 = $Conexao->query("
            UPDATE EST_PROD_PRECO_DELIVERY SET TP_DESCONTO = 'CD_ARV_MERC_CATEG' WHERE CD_PROD = ".$result['CD_PROD']."");
    
            $UPDATE1 = $query->fetchAll();
            $UPDATE2 = $query2->fetchAll();
    
        }catch(Exception $e){
            echo $e->getMessage();
            echo("<br>");
        }
    
    }

}else{ 
//se tiver desconto na linha
    
    $dividendo = (round($LINHA[0][0], 1));
    $divisor = (round($valor_tabela, 1));


    $resultado = ($divisor / $dividendo);
    $novo_preco = ($valor_tabela-$resultado);

    try{
        $Conexao = Conexao::getConnection();

        $query = $Conexao->query("
        UPDATE EST_PROD_PRECO_DELIVERY SET VLR_DELIVERY = $novo_preco WHERE CD_PROD = ".$result['CD_PROD']."");
        $query2 = $Conexao->query("
        UPDATE EST_PROD_PRECO_DELIVERY SET TP_DESCONTO = 'CD_ARV_MERC_LINHA' WHERE CD_PROD = ".$result['CD_PROD']."");

        $UPDATE1 = $query->fetchAll();
        $UPDATE2 = $query2->fetchAll();

    }catch(Exception $e){
        echo $e->getMessage();
        echo("<br>");
    }


}



















