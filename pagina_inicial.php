<?php
// ### Configuração inicial ###
require_once 'teste/_app/config.php';

// Variavel Login com todas as classes
$Login = $fb->getRedirectLoginHelper(); //  Instanciando a Helper de Login.
$permissions = ['email']; // Permissão pra obter o email do usuário.

// ### Validações,verificações de sessão e SDK. ###
try {  // Tentar
    if (isset($_SESSION['facebook_access_token'])) { // Se existir facebook_access_token (unico de cada usuário.)
        $accessToken = $_SESSION['facebook_access_token']; // Recebe o token do usuário (caso ele faça login e aceite)
    } else { // Caso não exista
        $accessToken = $Login->getAccessToken();  // Na variavel login, gera um Token.
    }
} catch (Facebook\Exceptions\FacebookResponseException $e) { //Exceção caso o usuário não libere certo acesso a determinada informação
    echo 'Graph returned an error: ' . $e->getMessage(); // Gera um erro.
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) { // Exceção da versão do SDK. caso seja incompativel com o mais atual.
    echo 'Facebook SDK returned an error: ' . $e->getMessage(); // Mensagem de erro.
    exit;
} // #################

//####### Verificação da validação do longin do usuário ########
if (isset($accessToken)) { // Se existe o accessToken
    if (isset($_SESSION['facebook_access_token'])) { // Se existir a Sessão facebook_access_token.
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']); // Seta dentro da variável $fb um token padrão o novo da sessão.
    } else { // Caso não gere um accessToken default
        $_SESSION['facebook_access_token'] = (string) $accessToken;  // Pega o accessToken gerado pela sessão
        $oAuth2Client = $fb->getOAuth2Client(); // Entra na autenticação pelo método getOAuth2Client.
        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']); // Prolongar a sessão, deixando o accessToken com uma longa vida.
        $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken; //Refaz a sessão recebendo um token de longa vida (Tempo longo de duração)
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']); // Seta como token  padrão, dizendo que o usuário está logado.
    } // #################

    // ###### Caso retorne algum codigo de erro pela URL
    if (isset($_GET['code'])) { // Pega o codigo de erro na URL
        header('Location: ./'); // Página inicial, não permitindo o login e acesso.
    }
    try { // Tenta
        $profile_request = $fb->get('/me?fields=name,first_name,last_name,email'); // Instancia a variável e faz uma pesquisa dentro do perfil do usuário.
        $profile = $profile_request->getGraphNode()->asArray(); // $Profile recebe todos os campos pedidos ( nomes e email).
    } catch (Facebook\Exceptions\FacebookResponseException $e) { // Caso haja erro, seja de permissão ou acesso a informação.
        echo 'Graph returned an error: ' . $e->getMessage(); // Mostra mensagem de erro
        session_destroy(); //Destroi a sessão
        header("Location: ./"); // Vai pra página inicial.
        exit; // Vaza :v kk
    } catch (Facebook\Exceptions\FacebookSDKException $e) { // Se houver erro por conta do SDK
        echo 'Facebook SDK returned an error: ' . $e->getMessage(); // Trava a aplicação e mostra mensagem de erro.
        exit;
    } // ##########
                    //var_dump($profile); <- dados do usuário
    // Logoff
    $logoff = filter_input(INPUT_GET, 'sair', FILTER_DEFAULT); // Caso o usuário deseje sair.
    if (isset($logoff) && $logoff == 'true'): // verifica  se é verdadeiro
        session_destroy(); // Sai da sessão
        header("Location: ./"); // volta pra página inicial.

    endif;

}else {  // ### Fazendo o login do usuário
    $loginUrl = $Login->getLoginUrl('http://localhost/eventstudy/pagina_inicial.php', $permissions); //Redirecionando pra página do app
    //  echo '<a href="' . $loginUrl . '">Entrar com facebook</a>';
    //echo $accessToken;  // O ID do usuário gerado aqui, deve ser inserido no banco, pra futuras autenticações.
    //var_dump($_SESSION); // OBS :  Não é o ID no facebook, é o ID gerado pela API, no caso deve-se por ela no banco.
}
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

        if(e.target.id != subject.attr('id'))
        {
            subject.fadeOut(1); /*Tempo em milisegundos para a sidebar desaparecer(esse tempo específico é necessário para criar o efeito)*/
        }
     });
});

    </script>

    

</head>

<body>


   <div  id="minhaNavbar" class="minhaNav">
       <ul>
          <li id="logo"><a href="#">EventStudy</a></li>
         
          
          <li style="float:right" class="scroll toggle_menu2 toggled " href="#"><i class="fa fa-user-plus icones_menus" aria-hidden="true"></i>
          <li style="float:right" class="scroll toggle_menu toggled " href="#"><i class="fa fa-sign-in icones_menus" aria-hidden="true"></i></li>
           <li style="float:right" class="" href="pagina_inicial.html"><i class="fa fa-home icones_menus" aria-hidden="true"></i></li>
</li>
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
                <form action="#" class="form-group">
                    <label for="Login">Login</label><br>
                    <input type="text" name="login"><br><br>
                    <label for="Senha">Senha</label><br>
                    <input type="password" name="senha"><br><br>
                    <input class="btn btn-info" type="submit" value="Entrar">

                </form>
                <a href="#">
                    <h6>Esqueceu senha?</h6>
                </a>
                <a href="#">
                    <h6>Cadastrar novo usuário</h6>
                </a>
                <i class="fa fa-google" aria-hidden="true"></i>
             
 <a href="<?= $loginUrl?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </div>
        </center>
    </section>

    <!-- FIM SIDEBAR LOGIN -->

    <!-- INICIO SIDEBAR CADASTRO -->
    <section class="sidebar_cadastro">
        <i class="fa fa-times aki2"></i>

        <center>
            <a class="boxed-item" href="#">
                <h3>CADASTRO</h3>
            </a>

            <div>
                <form action="#" class="form-group">

                    <label for="Login">Login</label><br>
                    <input type="text" name="login"><br><br>

                    <label for="Email">Email</label><br>
                    <input type="text" name="email"><br><br>

                    <label for="Senha">Senha</label><br>
                    <input type="password" name="senha"><br><br>

                    <label for="Repita-a-senha">Repita a senha</label><br>
                    <input type="password" name="senha-repetida"><br><br>

                    <input class="btn btn-info" type="submit" value="Entrar">

                </form>
                <a href="#">
                    <h6>Esqueceu senha?</h6>
                </a>
                <a href="#">
                    <h6>Já estou cadastrado</h6>
                </a>
                <i class="fa fa-google" aria-hidden="true"></i>
                <i class="fa fa-facebook" aria-hidden="true"></i>
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </div>
        </center>
    </section>

    <!-- FIM SIDEBAR CADASTRO -->


    <section class="primeira-sessao fechar_sidebar_se_clicado">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Teste</h1>
                    <?php
                   echo $profile['email'];


                    ?>
                </div>
            </div>
        </div>
    </section>


    <section class="eventos-index fechar_sidebar_se_clicado">

        <div  class="buscar col-lg-12 col-md-12 ">
            <div  class="input-group">
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
