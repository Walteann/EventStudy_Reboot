<?php
//Mudanças - Solon - Cadastro e Autenticação de Usuário
/*====LOGIN DO USUÁRIO*/
$erro = isset($_GET['erro']) ? $_GET['erro'] : 0;
/*====CADASTRO DE USUÁRIOS*/
/*=Login já existe no Banco de Dados ?*/
$erro_login		= isset($_GET['erro_login'])	? $_GET['erro_login'] : 0;
/*=Email já existe no Banco de Dados ?*/
$erro_email		= isset($_GET['erro_email'])	? $_GET['erro_email']	: 0;
/*=Senha e Repetição de senha não coincidem ?*/
$erro_senha 	= isset($_GET['erro_senha'])	? $_GET['erro_senha']	: 0;
/*=Quando o cadastro for realizado, retornará esse GET, pra que seja mostrada uma mensagem de cadastro realizado*/
$cadastro_realizado = isset($_GET['cadastro_realizado'])	? $_GET['cadastro_realizado']	: 0;
//Fim das Mudanças - Solon - Cadastro e Autenticação de Usuário

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
$loginUrl = $Login->getLoginUrl('http://localhost/eventstudy/pagina_inicial.php', $permissions); //Redirecionando pra página do app
 ?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google-signin-scope" content="profile email">
        <meta name="google-signin-client_id" content="664587044292-avitmflmcbh4tgk4l17l71hvl9un0ski.apps.googleusercontent.com">
        <script src="https://apis.google.com/js/platform.js" async defer></script>
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
<!-- ############### BOTÃO DO GOOGLE ##################### -->
        <style type="text/css">
        @import url(http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,600,700,400);
        .g-signin2,
        .g-signin2 .abcRioButton {
          display: block;
          data-width: 50px;
          data-height: 50px;
          border-radius: 50px;
          margin-top: 10px;
        padding: -2px;

        }
        </style>
<!--############################################################ -->
    </head>

    <body>


        <div id="minhaNavbar" class="minhaNav fechar_sidebar_se_clicado">
            <ul>
                <li id="logo"><a href="#">EventStudy</a></li>


                <li style="float:right" class="scroll toggle_menu2 toggled " href="#"><i class="fa fa-user-plus icones_menus" aria-hidden="true"></i></li>
                <li style="float:right" class="scroll toggle_menu toggled " href="#"><i class="fa fa-sign-in icones_menus" aria-hidden="true"></i></li>
                <li style="float:right" class="" href="pagina_inicial.html"><i class="fa fa-home icones_menus" aria-hidden="true"></i></li>
            </ul>
        </div>




        <!-- INICIO SIDEBAR LOGIN-->
        <section class="sidebar_login">
            <i class="fa fa-times aki1"></i>

            <center>
                <a class="boxed-item" href="#">
                    <h3>LOGIN</h3>
                </a>

                <div>
                    <form action="autenticacao.php" class="form-group" method="POST">
                        <label for="Login">Login</label><br>
                        <input type="text" name="login"><br><br>
                        <label for="Senha">Senha</label><br>
                        <input type="password" name="senha"><br><br>
                        <input class="btn btn-info" type="submit" value="Entrar">
                    </form>
                    <?php
                        if($erro == 1){

                            echo '<font color="yellow">--Usuário e ou senha inválido(s)-- Mudar cor</font>';
                        }
                    ?>
                        <a href="#">
                            <h6>Esqueceu senha?</h6>
                        </a>
                        <a href="#">
                            <h6>Cadastrar novo usuário</h6>
                        </a>

                        <div class="redeSocial">
              						<div class="googl">
              							  <div class="g-signin2" data-onsuccess="onSignIn"  data-theme="dark" data-width="50" data-height="50" data-longtitle="false" data-lang="pt-BR" data-redirecturi="postmessage"></div>
              						</div>
                            <div class="face">
                                <a href="<?= $loginUrl?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            </div>

                        </div>
                </div>
            </center>
        </section>

        <!-- FIM SIDEBAR LOGIN -->

        <!-- INICIO SIDEBAR CADASTRO -->
        <section class="sidebar_cadastro">
            <i class="fa fa-times aki2"></i>

            <center class="scrollCenter">
                <label class="boxed-item" href="#">
					<h3>CADASTRO</h3>
				</label>

                <div>
                    <form action="registra_usuario.php" method="POST" id="form-usuario" class="form-group">
                        <label for="login">Login</label><br>
                        <input type="text" name="login">
                        <?php
							if($erro_login){ // 1/true 0/false
								echo '<br><font style="color:#FF0000">Login já cadastrado</font>';
							}
						?>
                            <br>
                            <label for="email">Email</label><br>
                            <input type="email" name="email">
                            <?php
							if($erro_email){ // 1/true 0/false
								echo '<br><font style="color:#FF0000">Email já cadastrado</font>';
							}
						?>
                                <br>
                                <label for="senha">Senha</label><br>
                                <input type="password" name="senha">
                                <?php
							if($erro_senha){ // 1/true 0/false
								echo '<br><font style="color:#FF0000">Senhas não coincidem</font>';
							}
						?>
                                    <br>
                                    <label for="repetir-senha">Repita a senha</label><br>
                                    <input type="password" name="repetir-senha">
                                    <?php
							if($erro_senha){ // 1/true 0/false
								echo '<br><font style="color:#FF0000">Senhas não coincidem</font>';
							}
						?>
                                        <br><br>
                                        <input class="btn btn-info" type="submit" value="Cadastrar">

                    </form>

                    <div class="redeSocial">
                        <div class="googl">
                            <i class="fa fa-google face" aria-hidden="true"></i>
                        </div>
                        <div class="face">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </div>

                    </div>
                </div>
            </center>
        </section>

        <!-- FIM SIDEBAR CADASTRO -->


        <section class="primeira-sessao fechar_sidebar_se_clicado">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <a href="home.php">Se logado, va -> </a>
                        <h1>Teste</h1>

                        <?php
                   echo $profile['email'];


                    ?>
                            <?php
                    	if ($cadastro_realizado) {
                    		echo "<h1>OK</h1>";
                    	}
                    ?>
                    </div>
                </div>
            </div>
        </section>


        <section class="eventos-index fechar_sidebar_se_clicado">

            <div class="buscar col-lg-12 col-md-12 ">
               
               
               <!-- ####################  ALTEREI AQUI ######################################### -->
                      <form class="input-group" action="http://localhost/eventstudy/home.php/"  method="post">
                        <input type="text" name="aqui" class="form-control input-buscar" placeholder="Procure um evento">
                        <input class="btn btn-default" type="submit" value="buscar">
                      </form>
                <!-- ##################################### AQUI #################-->
               <!--
                <div class="input-group" action="http://localhost/eventstudy/home.php/" method="post" >
                    <input  type="text" class="form-control input-buscar" placeholder="Procurar evento">
                    <span class="input-group-btn">
        	<input class="btn btn-default" type="sutmit" value="buscar" size="5">
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


        <script>
        function onSignIn(googleUser) {
          var profile = googleUser.getBasicProfile();
          console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
          console.log('Name: ' + profile.getName());
          console.log('Image URL: ' + profile.getImageUrl());
          console.log('Email: ' + profile.getEmail());
          var id_token = googleUser.getAuthResponse().id_token;
          console.log("ID Token: " + id_token);
        }

        </script>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    </body>

    </html>
