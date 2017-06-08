<?php

// ### Configuração inicial ###
require_once 'teste/_app/config.php';


$id = $_POST['aqui'];


	// type can be user, group, page or event
	$search = $fb->get('/search?q='.$id.'&type=event');
	$search = $search->getGraphEdge()->asArray();

// Variavel Login com todas as classes
$Login = $fb->getRedirectLoginHelper(); //  Instanciando a Helper de Login.
$permissions = ['email']; // Permissão pra obter o email do usuário.

$logoff = filter_input(INPUT_GET, 'sair', FILTER_DEFAULT); // Caso o usuário deseje sair.
if (isset($logoff) && $logoff == 'true'): // verifica  se é verdadeiro
    session_destroy(); // Sai da sessão
    header("Location: ./"); // volta pra página inicial.
endif;

// ### Fazendo o login do usuário
$loginUrl = $Login->getLoginUrl('http://localhost/eventstudy/home.php', $permissions); //Redirecionando pra página do app
 ?>


<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>EventStudy</title>

		<!--Fontes-->
		
		<link href="https://fonts.googleapis.com/css?family=Bangers" rel="stylesheet">
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		
		
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

						nav.removeClass("navegacao");
					} else {

						nav.removeClass("menu-fixo");
					}
				});
			});

			$(document).ready(function() {
				$(".aki1").click(function() {
					$(".sidebar_login").toggle();
					$(".toggle_menu").addClass("opacity_one");
				});

				$(".toggle_menu").click(function() {
					$(".sidebar_login").toggle();
					/*$(".sidebar_login").removeClass("hide_menu");*/
					$(".toggle_menu").removeClass("opacity_one");
				});
			});



			$(document).ready(function() {
				$(".aki2").click(function() {
					$(".sidebar_cadastro").toggle();
					$(".toggle_menu2").addClass("opacity_one2");
				});

				$(".toggle_menu2").click(function() {
					$(".sidebar_cadastro").toggle();

					$(".toggle_menu2").removeClass("opacity_one2");
				});
			});

			$(document).ready(function() {

				$(".fechar_sidebar_se_clicado").mouseup(function(e) { /*Divs/Sections com essa classe serão as afetadas pelo cloque fora das sidebars*/

					var subject = $(".sidebar_login, .sidebar_cadastro"); /*As que serão fechadas*/

					if (e.target.id != subject.attr('id')) {
						subject.fadeOut(1); /*Tempo em milisegundos para a sidebar desaparecer(esse tempo específico é necessário para criar o efeito)*/
					}
				});
			});

		</script>

<!-- Teste css -->
	<style>
	
		body {
	margin: 0;
	padding: 0;
}

.panel_default {
	border: 1px solid #FFFFFF;
	height: 600px;
	width: 400px;
}


/* NAVEGACAO */

.minhaNav {
    padding-top: 5px;
	width: 100%;
	position: fixed;
	background-color: transparent;
	height: 50px;
	z-index: 9000;
	transition: background-color 1s ease 0s;
}

.minhaNav #logo {
	color: #FFFFFF !mportant;
	font-family: 'Bad Script', Arial, sans-serif;
	text-decoration: none;
	font-size: 18pt;
	transition: text-shadow 5s;
}

.minhaNav #logo a {
	color: #FFF;
}

.minhaNav #logo a:hover {
	text-decoration: none;
	text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
}

.minhaNav #logo a:visited {
	color: white;
}

ul {
	list-style-type: none;
	margin: 0;
	padding: 0;
	overflow: hidden;
	text-decoration: none;
}

li {
	float: left;
}

li {
	display: block;
	color: white;
	text-align: center;
	padding: 6px 7px;
	text-decoration: none;
}

.minhaNav i {
	padding: 7px;
	font-size: 18pt;
}

.icones_menus {
	margin-top: -5px;
	width: 40px;
	height: 40px;
	background-color: transparent;
	border-radius: 10px;
	transition: all 0.5s;
}

.icones_menus:hover {
	color: #43d3e8;
	font-size: 22pt;
	text-shadow: 1px 1px 2px white, 0 0 2px white, 0 0 2px white;
}


/* FIM NAVEGAÇÃO */


/* SCROOL */

.menu-fixo {
	position: fixed;
	width: 100%;
	height: 50px;
	background-color: #2897d4;
}

.menu-fixo #logo a {
	margin-bottom: 15px;
	font-family: 'Bad Script';
	color: white;
	text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
}

.menu-fixo .icones_menus {
	text-shadow: 1px 1px 2px #43d3e8, 0 0 25px blue, 0 0 5px darkblue;
}

.menu-fixo .icones_menus:hover {
	text-shadow: 1px 1px 2px white, 0 0 2px white, 0 0 2px white;
}


/* LOGIN SIDEBAR  */

.sidebar_login {
	
	display: none;
	margin-top: 50px;
	position: fixed;
	width: 300px;
	margin-left: 0px;
	overflow: hidden;
	height: 900px;
	background-color: rgba(6, 90, 130, 0.8);
	transition: all 0.3s ease-in-out;
	z-index: 9000;
}

.fa-times {
	right: 10px;
	top: 10px;
	opacity: 0.7;
	cursor: pointer;
	position: absolute;
	color: white;
	transition: all 0.3s ease-in-out;
}

.fa-times:hover {
	opacity: 1;
}

.boxed-item {
	font-family: "Open Sans", Arial, sans-serif;
	font-weight: 200;
	padding: 2px 4px;
	display: inline-block;
	color: #1ae1ff;
	margin-top: 10px;
	text-align: center;
}

.sidebar_login h6,
label {
	font-family: "Roboto", Arial, sans-serif;
	color: #1ae1ff;
}

.hide_menu {
	margin-left: -300px;
}

.opacity_one {
	opacity: 1;
}

.opacity_one2 {
	opacity: 1;
}


/** CADASTRO **/

.sidebar_cadastro {

	overflow-y:scroll;
	display: none;
	margin-top: 50px;
	position: fixed;
	width: 300px;
	height: 100%;
	margin-left: 0px;
	overflow: hidden;
	height: 900px;
	background-color: rgba(6, 90, 130, 0.8);
	transition: all 0.6s ease-in-out;
	z-index: 9000;
}

.fa-times {
	right: 10px;
	top: 10px;
	opacity: 0.7;
	cursor: pointer;
	position: absolute;
	color: white;
	transition: all 0.6s ease-in-out;
}

.fa-times:hover {
	opacity: 1;
}

.scrollCenter{
	overflow-y:show;
}


.sidebar_cadastro h6 {
	color: #1ae1ff;
}

.hide_menu {
	margin-left: -300px;
}

.opacity_one {
	opacity: 1;
}


/*REDESOCIAL*/

.redeSocial {
	width: 150px;
	height: 50px;
	font-size: 25pt;
	text-align: center;
	display: flex;
	flex-direction: row;
	justify-content: center;
}

.redeSocial i {
	margin: 10px;
}

div.face i {
	padding: 10px;
	width: 50px;
	height: 50px;
	background-color: #4b67a1;
	color: white;
	border-radius: 50px;
}

div.googl i {
	padding: 10px;
	width: 50px;
	height: 50px;
	background-color: #db4936;
	color: white;
	border-radius: 50px;
}

div.face i:hover,
div.googl i:hover {
	opacity: 0.8;
}


/** FIM CADASTRO**/


/** Primeira sessão */

.primeira-sessao {
	display: flex;
	flex-direction: row;
	justify-content: space-around;
	text-align: center;
	align-items: center;
	width: 100%;
	background-image: url("../imagens/Palestra_ibc.jpg");
	background-repeat: no-repeat;
	background-position: center center;
	background-size: cover;
	height: 600px;
}


/* Fim primeira sessão **/


/** Eventos index **/

.eventos-index {
	background-color: #eff7fc;
	display: flex;
	flex-direction: column;
	flex-wrap: wrap;
	align-items: center;
	text-align: center;
	width: 100%;
	padding-top: 70px;
	padding-bottom: 60px;
}

.eventos-index .buscar {
	margin-top: -25px;
	margin-bottom: 25px;
	display: flex;
	flex-direction: row;
	justify-content: center;
	text-align: center;
	align-items: center;
	width: 300px;
}
		.osEventos {
			border: 1px solid blue;
			display: flex;
			flex-direction: row;
			justify-content: center;
			flex-wrap: wrap;
		}
		
		.listarEventos {
			border: 1px solid red;
			height: auto;
			width: 320px;
			margin: 10px;
			padding: 5px;
		}

/** FIM eventos index **/

.sobre-nos {
	display: flex;
	flex-direction: column;
	justify-content: space-around;
	background-color: #2897d4;
	width: 100%;
	padding: 15px;
	text-align: center;
	align-items: center;
}

.sobre-nos h2 {
	font-family: "Roboto", Arial, sans-serif;
	text-transform: uppercase;
	color: #FFFFFF;
}


/**** Footer ****/

footer {
	display: flex;
	flex-direction: column;
	align-items: center;
	padding: 10px;
	color: #a6aaad;
	background-color: #363636;
}

.redesocial {
	display: flex;
	flex-direction: row;
	align-items: center;
	height: 70px;
}

footer a img {
	display: flex;
	flex-direction: row;
	justify-content: space-around;
	align-items: center;
	height: 40px;
	opacity: 0.3;
	transition: 0.5s;
	margin: 2px;
}

footer a img:hover {
	height: 40px;
	opacity: 1.0;
}


/* FIM Footer */


/* MEDIA QUERY PARA TABLET */

@media only screen and (min-width: 768px) {
	.eventos-index {
		flex-direction: row;
		justify-content: space-around;
	}
	.eventos-index img {
		width: 170px;
	}
	.eventos-index .buscar {
		width: 450px;
	}

	.listarEventos {
			
			width: 450px;
		}
}

		
	
	</style>
<!-- Teste css -->

	</head>

	<body>


		<div id="minhaNavbar" class="minhaNav fechar_sidebar_se_clicado">
			<ul>
				<li id="logo"><a href="#">EventStudy</a></li>

        <!-- MUDEI AQUI  -->
				<li style="float:right"  class="scroll toggle_menu2 toggled ">
            <a href="?sair=true" >
                <i class="fa fa-sign-out icones_menus" aria-hidden="true"></i>
            </a>
        </li>

        <!-- FIM DA MINHA MUDANÇA  -->

					<li style="float:right" class="scroll toggle_menu toggled " href="#"><i class="fa fa-cog icones_menus" aria-hidden="true"></i></li>
					<li style="float:right" class="" href="home.html"><i class="fa fa-home icones_menus" aria-hidden="true"></i>
				</li>
			</ul>
		</div>


		





	


		<section class="primeira-sessao fechar_sidebar_se_clicado">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12">

          
					</div>
				</div>
			</div>
		</section>


		<section class="eventos-index fechar_sidebar_se_clicado">

			<div class="buscar col-lg-12 col-md-12 ">
				 <!-- ####################  ALTEREI AQUI ######################################### -->
                      <form class="input-group" action="http://localhost/eventstudy/home.php/"  method="post">
                        <input type="text" name="aqui" class="form-control input-buscar" placeholder="Digite o evento">
                        <input class="btn btn-default" type="submit" value="buscar">
                      </form>
                <!-- ##################################### AQUI #################-->
			</div>


			<div class="col-lg-12 col-md-12">
			
					
			
				<!-- ########################## ALTEREI AQUI ########################################### --><h1>Teste</h1>
				<div class="osEventos">
         
            <?php
		
		foreach ($search as $key) { ?>

			<div class="listarEventos">
             
              <strong>Nome do evento :</strong>  <?= $key['name'] ?> <br>
              <strong>Lugar do evento :</strong> <?= $key['place']['name']?><br>
              <strong>Cidade do evento :</strong> <?= $key['place']['location'] ['city']?><br>
              <strong>Rua do evento :</strong> <?=$key['place']['location'] ['street']?><br>
              <strong>CEP do evento :</strong> <?=$key['place']['location'] ['zip']?><br>
              <strong>Descrição do evento :</strong>  <?=$key['description']?> <br> <br>

              <button href='<?php $key["place"]["url"]?>' class="btn btn-success">INSCREVER-SE</button>
            </div>
          
            <?php }?>
<!-- ############################# até aqui ################################### -->


				</div>
			
                   		</div>
                    		
		
						<?php
                   echo $profile['email'];


                    ?>
		</section>

		<section class="sobre-nos fechar_sidebar_se_clicado">
			<div>
				<h2>Sobre Nós</h2>
				<p>Orem ipsum dolor sit amet, consectetur adipiscing elit. Cras ac mi purus. Nulla nec lacus pellentesque, dapibus lectus vitae, sagittis odio. Integer pellentesque dignissim congue. Donec tempus aliquam eleifend. Aliquam vitae purus nibh. In quis sem id velit scelerisque malesuada nec non dolor. Praesent varius vitae mi a luctus. Donec tempus odio nisl, et congue urna elementum vitae. Sed purus metus, convallis vitae malesuada sed, dictum eu velit.</p>
			</div>
		</section>

		<footer>
			<div class="redesocial fechar_sidebar_se_clicado">
				<a href="#" id="facebook"><img src="imagens/icones/facebook_dark.png"></a>
				<a href="#" id="google"><img src="imagens/icones/google_dark.png"></a>
				<a href="#" id="in"><img src="imagens/icones/in_dark.png"></a>
				<a href="#" id="twitter"><img src="imagens/icones/twitter_dark.png"></a>
			</div>
			<p>&copy; Todos os direitos reservados</p>
		</footer>






		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>
