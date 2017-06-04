<?php
session_start();

if(!isset($_SESSION['login'])){
	header('Location: pagina_inicial.php?erro=1');
}
// ### Configuração inicial ###
require_once 'teste/_app/config.php';

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



	</head>

	<body>


		<div id="minhaNavbar" class="minhaNav">
			<ul>
				<li id="logo"><a href="#">EventStudy</a></li>

        <!-- MUDEI AQUI  -->
				<li style="float:right" >
            <a href="sair.php" >
                <i class="fa fa-sign-out icones_menus" aria-hidden="true"></i>
            </a>
        </li>

        <! -- FIM DA MINHA MUDANÇA  -->

					<li style="float:right"  href="#"><i class="fa fa-cog icones_menus" aria-hidden="true"></i></li>
					<li style="float:right" class="" href="home.html"><i class="fa fa-home icones_menus" aria-hidden="true"></i>
				</li>
			</ul>
		</div>





		<!-- FIM SIDEBAR CADASTRO -->


		<section class="primeira-sessao fechar_sidebar_se_clicado">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12">

            <h1>Home</h1>
						<?php
                   echo $profile['email'];


                    ?>
					</div>
				</div>
			</div>
		</section>


		<section class="eventos-index fechar_sidebar_se_clicado">

			<div class="buscar col-lg-12 col-md-12 ">
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
