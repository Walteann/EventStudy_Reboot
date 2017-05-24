<?php
//### Iniciando configurações ###
session_start(); // Inicia a session
require_once 'Facebook/autoload.php'; // Importa o autoload.


//#### Configuração do login da API do Facebook ###

$fb = new Facebook\Facebook([  // Instanciando classe facebook.
  'app_id' => '291865097928347', // ID da API (Apenas adm)
  'app_secret' => '89e6b4a112716e8fc7601bdd9924ce80', // Senha da API (Apenas adm)
  'default_graph_version' => 'v2.9',
  ]);

//###############################################
//############# Validações ##############

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
}
 ?>
