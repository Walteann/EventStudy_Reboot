<?php

	$erro_login		= isset($_GET['erro_login'])	? $_GET['erro_login'] : 0;
	$erro_email		= isset($_GET['erro_email'])	? $_GET['erro_email']	: 0;
	$erro_senha 	= isset($_GET['erro_senha'])	? $_GET['erro_senha']	: 0;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>CRUD</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  	
  </head>
  <body>
  	
  	<div class="container">
  		<h2>INSCREVER-SE NO SITE -- PÁGINA SUJEITA A ALTERAÇÃO</h2>
  		<div class="row">
  			<!--Formulario-->
  			<form action="registra_usuario.php" method="POST" id="form-usuario">
  			<div class="col-md-6">
  				<div class="form-group">
		    		<label for="nome">Nome:</label>
		    		<input type="nome" class="form-control" name="nome">

  				</div>

				<div class="form-group">
				    <label for="login">Login:</label>
				    <input type="login" class="form-control" name="login">
				    <?php
						if($erro_login){ // 1/true 0/false
							echo '<font style="color:#FF0000">Login já cadastrado</font>';
						}
					?>
	  			</div>

		  		<div class="form-group">
				    <label for="email">Email:</label>
				    <input type="email" class="form-control" name="email">
		  			<?php
						if($erro_email){ // 1/true 0/false
							echo '<font style="color:#FF0000">Email já cadastrado</font>';
						}
					?>
		  		</div>
				
		  		<div class="form-group">
				    <label for="senha">Senha:</label>
				    <input type="password" class="form-control" name="senha">
				    <?php
						if($erro_senha){ // 1/true 0/false
							echo '<font style="color:#FF0000">Senhas não coincidem</font>';
						}
					?>
		  		</div>

		  		<div class="form-group">
				    <label for="repetir-senha">Repetir Senha:</label>
				    <input type="password" class="form-control" name="repetir-senha">
				    <?php
						if($erro_senha){ // 1/true 0/false
							echo '<font style="color:#FF0000">Senhas não coincidem</font>';
						}
					?>
		  		</div>

				<button type="submit" class="btn btn-primary form-control">Inscreva-se</button>
		  		</div>
				<!-- Mapa-->
  			
  			<div class="col-md-6">
				 
  			</div>

		  		</form><!--Fim-Formulário-->
  			</div>
  			
  		</div> <!--Fim-Row-->
  	</div> <!--Fim-Cotainer-->
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>