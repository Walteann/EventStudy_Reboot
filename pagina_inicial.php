<?php

    $erro = isset($_GET['erro']) ? $_GET['erro'] : 0;
    /*====Quando o cadastro for realizado, retornará esse GET, pra que seja mostrada uma mensagem de cadastro realizado*/
    $cadastro_realizado = isset($_GET['cadastro_realizado']);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>EventStudy</title>

    <!--Fontes-->
    <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bangers" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" href="css/fontes/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Bad+Script|Nunito|Open+Sans|Roboto" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script>
        $(function() {
            var nav = $('#minhaNavbar');
            $(window).scroll(function() {
                if ($(this).scrollTop() > 170) {
                    nav.addClass("menu-fixo");

                    nav.removeClass("navbar-inverse");
                } else {

                    nav.removeClass("menu-fixo");
                }
            });
		  
		  
		  
		  

        });
	    
	    
	    $(document).ready(function(){
		    $(".fa-times").click(function(){
			 $(".sidebar_login").addClass("hide_menu");
			 $(".toggle_menu").addClass("opacity_one");
		  });
		  
		    $(".toggle_menu").click(function(){
			 $(".sidebar_login").removeClass("hide_menu");
			 $(".toggle_menu").removeClass("opacity_one");
		  });
	    });
	    
	    
	   
    </script>




</head>

<body background="imagens/WhatsApp-Hintergrund1.jpg">


    <nav id="minhaNavbar" class="navbar  navbar-transparent navbar-fixed-top " role="navigation">

        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                  
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  
                </button>

                <a href="pagina_inicial.html" class="navbar-brand">
                    <h1 id="logo">EventStudy</h1>
                </a>
            </div>
            <div class="navbar-collapse collapse" id="menu">

                <ul class="nav navbar-nav navbar-right">
                    <li><a class="scroll" href="pagina_inicial.php">PAGINA INICIAL</a></li>
                    <li><a class="scroll toggle_menu" href="#entrar">ENTRAR</a></li>
                    <li><a class="scroll" href="cadastro_usuario.php">CADASTRAR</a></li>

                </ul>
            </div>
        </div>
    </nav>
    
    <section class="sidebar_login">
    		<i class="fa fa-times"></i>
    		
    		<center>
    			<a class="boxed-item" href="#"><h3>LOGIN</h3></a>
    			
    			<div>
    				<form action="autenticacao.php" class="form-group" method="POST">
    					<label for="Login">Login</label><br>
    					<input type="text" name="login"><br><br>
    					<label for="Senha">Senha</label><br>
    					<input type="password" name="senha"><br><br>
    					<input  class="btn btn-info" type="submit" value="Entrar">    					
    				</form>
                    <?php
                        if($erro == 1){
                            echo '<font color="yellow">--Usuário e ou senha inválido(s)-- Mudar cor</font>';
                        }
                    ?>
    				<a href="#"><h6>Esqueceu senha?</h6></a>
    				<a href="cadastro_usuario.php"><h6>Cadastrar novo usuário</h6></a>
    				<i class="fa fa-google" aria-hidden="true"></i>
    				<i class="fa fa-facebook" aria-hidden="true"></i>
    				<i class="fa fa-twitter" aria-hidden="true"></i>
    			</div>
    		</center>
    </section>
    
    

    <section class="primeira-sessao">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Teste</h1>
                </div>
            </div>
        </div>
    </section>


    <section class="eventos-index">
       
        <div class="buscar col-lg-12 col-md-12">
            <div class="input-group">
                <input type="text" class="form-control input-buscar" placeholder="Procurar evento">
                <span class="input-group-btn">
        <button class="btn btn-default" type="button">BUSCAR</button>
      </span>
            </div>
            <!-- /input-group -->
        </div>
        
        
        <div class="col-lg-12 col-md-12">
        <img src="imagens/eventos/campusparty.png">
        <img src="imagens/eventos/hackthon.jpg">
        <img src="imagens/eventos/flisol.png">
        <img src="imagens/eventos/foto-2-1.png">

        </div>
    </section>

    <section id="sobre-nos">
        <div>
            <h2>Sobre Nós</h2>
            <p>orem ipsum dolor sit amet, consectetur adipiscing elit. Cras ac mi purus. Nulla nec lacus pellentesque, dapibus lectus vitae, sagittis odio. Integer pellentesque dignissim congue. Donec tempus aliquam eleifend. Aliquam vitae purus nibh. In quis sem id velit scelerisque malesuada nec non dolor. Praesent varius vitae mi a luctus. Donec tempus odio nisl, et congue urna elementum vitae. Sed purus metus, convallis vitae malesuada sed, dictum eu velit.</p>
        </div>
    </section>

    <footer>
        <div class="redesocial">
            <a href="#" id="facebook"><img src="imagens/icones/facebook_dark.png"></a>
            <a href="#" id="google"><img src="imagens/icones/google_dark.png"></a>
            <a href="#" id="in"><img src="imagens/icones/in_dark.png"></a>
            <a href="#" id="twitter"><img src="imagens/icones/twitter_dark.png"></a>
        </div>
        <p>&copy Todos os direitos reservados</p>
    </footer>





    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>