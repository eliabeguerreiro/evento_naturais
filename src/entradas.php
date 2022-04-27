<?php

session_start();
include_once './functions/conexao.php';





?>

<div class="search">
    <form method="GET" action="" class="d-flex" id="searchbar">
        <label>Nome / CPF / E-mail</label>
 
            <input name='pesquisa' type="search" placeholder="Procurar...">
            <i class="fas fa-search"></i>
        
    </form>
</div>

<div>
    <table id='customers'>
       
            <?php

            if($_GET){

                $select_cliente = "SELECT * FROM participantes WHERE NOME like '%".$_GET['pesquisa']."%' OR CPF like '%".$_GET['pesquisa']."%' OR EMAIL like '%".$_GET['pesquisa']."%' ";
            
                ?>
                        <h3>Resultado da pesquisa:</h3>
                        <thead>
                            <tr>

                                <th>Numero do ingresso:</th>   
                                <th>Nome:</th>
                                <th></th>
                                <th>CPF:</th>
                                <th></th>
                                <th>E-mail:</th>

                            </tr>

                        </thead>

                        <tbody>


                        <?php

                $query_cliente = mysqli_query($conn, $select_cliente);

            

                while($cliente = mysqli_fetch_assoc($query_cliente)){

                    
                    $select_ingresso = "SELECT * FROM entradas WHERE id_cliente = '".$cliente['ID']."'";
                    $query_ingresso = mysqli_query($conn, $select_ingresso);
                    $ingressos = mysqli_fetch_assoc($query_ingresso);

                        
                        echo("
    
                        <tr>
                        <td>".$ingressos['codigo']."</td>
                        <td>".$cliente['NOME']."</td>
                        <td></td>
                        <td>".$cliente['CPF']."</td>
                        <td></td>
                        <td>".$cliente['EMAIL']."</td>
                        <td></td>
                        <!--td> <a href='#' type='button' class='btn btn-primary'>Confirmar Presença</a></td-->
                        </tr>
    
                        ");
                }

            }else{

                $select_ingresso = "SELECT * FROM entradas";
                $query_ingresso = mysqli_query($conn, $select_ingresso);

                ?>
                    <h3>Todos os ingressos:</h3>
                    <thead>
                        <tr>

                            <th>Numero do ingresso:</th>   
                            <th>Nome:</th>
                            <th></th>
                            <th>CPF:</th>
                            <th></th>
                            <th>E-mail:</th>

                        </tr>

                    </thead>

                    <tbody>


                    <?php

                
            while($ingressos = mysqli_fetch_assoc($query_ingresso)){
                $select_cliente = "SELECT * FROM participantes WHERE ID = '".$ingressos['id_cliente']."'";
                $query_cliente = mysqli_query($conn, $select_cliente);
                $cliente = mysqli_fetch_assoc($query_cliente);
                    

                    echo("

                    <tr>
                    <td>".$ingressos['codigo']."</td>
                    <td>".$cliente['NOME']."</td>
                    <td></td>
                    <td>".$cliente['CPF']."</td>
                    <td></td>
                    <td>".$cliente['EMAIL']."</td>
                    <td></td>
                    <!--td> <a href='#' type='button' class='btn btn-primary'>Confirmar Presença</a></td-->
                    </tr>

                    ");
            }


            }



                ?>

    </tbody>

</table>
    </div>

<?php



