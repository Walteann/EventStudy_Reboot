<?php

class db {

	//host
	private $host = 'localhost'; //localhost     ou    mysql.hostinger.com.br

	//usuario
	private $usuario = 'root'; // root    ou    u698727888_fir3z

	//senha
	private $senha = ''; // ''     ou      @luno#2016

	//banco de dados
	private $database = 'eventstudy'; // eventstudy    ou   u698727888_fir3z

	public function conectar(){

		//criar a conexao
		$con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);

		//ajustar o charset de comunicação entre a aplicação e o banco de dados
		mysqli_set_charset($con, 'utf8');

		//verficar se houve erro de conexão
		if(mysqli_connect_errno()){
			echo 'Erro ao tentar se conectar com o BD MySQL: '.mysqli_connect_error();	
		}

		return $con;
	}

}

?>