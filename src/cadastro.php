<?php
session_start();
include("./functions/conexao.php");

//var_dump($_SESSION);


/*
if(!empty($_SESSION['usuario']['id']))
{}
else{$_SESSION['msg']='Você precisa logar para acessar o painel!</br>';
    header("Location: ../index.php");
} 
*/


if($_GET){
    if($_GET['modo'] == 'cortesia'){


                
        if($_POST){
           
            //echo(date('Y,m,d'));
            echo('<br>');

            
            $dados = $_POST;
                
            $cad = "INSERT INTO participantes (NOME, CPF, EMAIL, NUMERO, DT_NSC, CIDADE, BAIRRO, UF, SEXO) values 
            ('".$dados['NOME']."', '0', '".$dados['EMAIL']."', '0', '".date('Y,m,d')."', '0', '0', '0', '0') ";
            $cada = mysqli_query($conn, $cad);
            


            if($cada){
        
                $_SESSION['id_cliente'] = mysqli_insert_id($conn);
                header("Location: comprovante.php");

            }
            
        }

        ?>
        <!DOCTYPE html>
        <html lang="pt-br">

        <head>
            <title>Perfil</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- Bootstrap CSS CDN -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
                integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
            <!-- Our Custom CSS -->
            <link rel="stylesheet" href="./css/style.css">
            <!-- Link Google Icons -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
            <!-- Font Awesome JS -->
            <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
                integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
            </script>
            <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
                integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
            </script>
        </head>

        <body>
            <center>
                <?php

        ?>
        <main class="back">
    <section class="dashboard">
            <div style="background-color: #b0bd6d; padding: 50px 70px 50px 70px; border-radius: 15px; border-width: 2px; border-style: solid; border-color: #748535">
                <form method="POST" action="" enctype="multipart/form-data">
                    <h3>Todos os dados a seguir são obrigatorios!</h3>
                    <br>
                    <label>Digite o nome completo</label>
                    <input class="form-control" type="text" name="NOME" placeholder="Nome completo">
                    <br><br>
                    <label>Digite o e-mail</label>
                    <input class="form-control" type="mail" name="EMAIL" placeholder="exemplo@emali">
                    <br><br>
                    
                    <br><br><br>
                    <input class="btn btn-primary" type="submit" name="dados" value="Cadastrar"><br>
                    
                </form>
            </div>
         </main>
        </section>
        </center>
        </body>
        </html>


        <?php



    }

}else{

    if($_POST){

    
            //echo(date('Y,m,d'));
            echo('<br>');
            
            
            $dados = $_POST;
                  
            $_SESSION['dados']['cadastrais'] = $dados;    
            
            $cad = "INSERT INTO participantes (NOME, CPF, EMAIL, NUMERO, DT_NSC, CIDADE, BAIRRO, UF, SEXO) values 
            
            ('".$dados['NOME']."', '".$dados['CPF']."', '".$dados['EMAIL']."', '".$dados['NUMERO']."', '".$dados['DT_NSC']."', '".$dados['CIDADE']."', '".$dados['BAIRRO']."', '".$dados['UF']."', '".$dados['SEXO']."')";
            echo($cad);
            $cada = mysqli_query($conn, $cad);
            
            
            if($cada){
                $_SESSION['id_cliente'] = mysqli_insert_id($conn);
        
                header("Location: comprovante.php");
            }
            
        
    
    }
    
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    
    <head>
        <title>Perfil</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
            integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="./css/style.css">
        <!-- Link Google Icons -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
            integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
        </script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
            integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
        </script>
    </head>
    
    <body>
        <center>
            <?php
    
    ?>
    <main class="back">
    <section class="dashboard">
        <div style="background-color: #b0bd6d; padding: 50px 70px 50px 70px; border-radius: 15px; border-width: 2px; border-style: solid; border-color: #748535">
            <form method="POST" action="" enctype="multipart/form-data">
                <h3 style="color: #fff;">Todos os dados a seguir são obrigatorios!</h3>
                <br>
                <label style="color: #fff;">Digite seu nome completo</label>
                <input class="form-control" type="text" name="NOME" placeholder="Nome completo">
                <br><br>
                <label style="color: #fff;">Digite seu CPF</label>
                <input class="form-control" type="number" name="CPF" placeholder="número do CPF">
                <br><br>
                <label style="color: #fff;">Digite sua data de nascimento</label>
                <input class="form-control" type="date" name="DT_NSC" >
                <br><br>
                <label style="color: #fff;">Digite seu e-mail</label>
                <input class="form-control" type="mail" name="EMAIL" placeholder="exemplo@email.com">
                <br><br>
                <label style="color: #fff;">Digite seu telefone para contato</label>
                <input class="form-control" type="number" name="NUMERO" placeholder="DDD999999999">
                <br><br>
                
                
                <label for="endereco" style="color: #fff;">Sexo</label>
                    
                    <select class="form-control" name="SEXO" id="">
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                        <option value="0">Outro</option>
                    </select><br><br>  

                <label for="endereco" style="color: #fff;">Endereço</label>
    
                       
    
                    <select class="form-control" name="UF" id="">
                        <option value="">Selecione um Estado</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                        <option value="EX">Estrangeiro</option>
                    </select><br><br>   
                                        
    
                    <label style="color: #fff;">Digite sua Cidade</label>
                    <input class="form-control" type="test" name="CIDADE" placeholder="EX.: Campina Grande">
                    <br><br>
    
                    <label style="color: #fff;">Digite seu bairro</label>
                    <input class="form-control" type="text" name="BAIRRO" placeholder="Ex.: Catolé">
                    <br><br>
    
                    <input required type="checkbox" id="scales" name="autorizo">
                    <label style="color: #fff;" for="scales">Autorizo o uso dos meus dados para terceiros a fins comerciais, nos termos da Política de Privacidade e da Lei 12.965/14.</label>
                
    
    
                <br><br><br>
                <input class="btn btn-success" type="submit" name="dados" value="Cadastrar"><br>
    
            </form>
        </div>
    </main>
    </section>
            </center>
    </body>
    </html>
    <?php

}
