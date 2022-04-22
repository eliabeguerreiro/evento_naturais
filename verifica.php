<?php
session_start();
include_once("functions/conexao.php");
$btnLogin = filter_input(INPUT_POST, 'btnLogin', FILTER_SANITIZE_STRING);
if($btnLogin){
	$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
	$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
	
	//verificando login e senha
	if((!empty($usuario)) AND (!empty($senha))){
		$result_usuario = "SELECT * FROM vendedores WHERE nome = '$usuario' LIMIT 1;";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		
		if($resultado_usuario){
			$row_usuario = mysqli_fetch_assoc($resultado_usuario);
			
			//var_dump($row_usuario);
			
			ob_start();
			//coletando dados do banco

$dados = $senha;
$dados = password_hash($dados, PASSWORD_DEFAULT);

			if(password_verify($senha, $row_usuario['senha'])){
				
				$_SESSION['usuario'] = $row_usuario;
				header("Location:./src/index.php");
				
			}else{
				$_SESSION['msg'] = "Login ou senha incorretos!";
				
				header("Location:../index.php");
			}
		}
	}else{
		$_SESSION['msg'] = "Você precisar inserir os dados de login!";
		header("Location:../index.php");
	}
}else{
	$_SESSION['msg'] = "Página não encontrada";
	header("Location:../index.php");
}
ob_end_flush();