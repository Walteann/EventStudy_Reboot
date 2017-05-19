<?php

	session_start();

	require_once('conexao.php');

	$login = $_POST['login'];
	$senha = md5($_POST['senha']);

	$sql = " SELECT id, login, email FROM usuario WHERE login = '$login' AND senha = '$senha' ";

	$objDb = new db();
	$link = $objDb->conectar();

	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id){
		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['login'])){

			$_SESSION['id_usuario'] = $dados_usuario['id'];
			$_SESSION['login'] = $dados_usuario['login'];
			$_SESSION['email'] = $dados_usuario['email'];
			
			header('Location: home.php');

		} else {
			header('Location: pagina_inicial.php?erro=1');
		}
	} else {
		echo 'Erro na execução da consulta, favor entrar em contato com o admin do site';
	}


	


?>