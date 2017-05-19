<?php

	require_once('conexao.php');

	$nome = $_POST['nome'];
	$login = $_POST['login'];
	$email = $_POST['email'];
	$senha = md5($_POST['senha']);
	$repetir_senha = md5($_POST['repetir-senha']);

	$objDb = new db();
	$link = $objDb->conectar();

	$login_existe = false;
	$email_existe = false;

	//verificar se o login já existe
	$sql = " select * from usuario where login = '$login' ";
	if($resultado_id = mysqli_query($link, $sql)) {

		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['login'])){
			$login_existe = true;
		}
	} else {
		echo 'Erro ao tentar localizar o registro de usuário';
	}
	//verificar se o e-mail já existe
	$sql = " select * from usuario where email = '$email' ";
	if($resultado_id = mysqli_query($link, $sql)) {

		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['email'])){
			$email_existe = true;
		} 
	} else {
		echo 'Erro ao tentar localizar o registro de email';
	}


	if($login_existe || $email_existe){

		$retorno_get = '';

		if($login_existe){
			$retorno_get.= "erro_login=1&";
		}

		if($email_existe){
			$retorno_get.= "erro_email=1&";
		}

		header('Location: cadastro_usuario.php?'.$retorno_get);
		die();
	}
	
	//Verificar se as senhas coincidem
	if($senha != $repetir_senha){

		$retorno_get = '';
		
		$retorno_get.= "erro_senha=1&";

		header('Location: cadastro_usuario.php?'.$retorno_get);
		die();
	}

	$sql = " insert into usuario (nome, login, email, senha) values ('$nome', '$login', '$email', '$senha') ";

	//executar a query
	if(mysqli_query($link, $sql)){
		$retorno_get = '';
		$retorno_get = 'cadastro_realizado';
		header('Location: pagina_inicial.php?'.$retorno_get);
	} else {
		echo 'Erro ao registrar o usuário!';
	}


?>