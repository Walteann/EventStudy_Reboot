<?php
// ### Configuração inicial ###
require_once '_app/config.php';

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
    var_dump($profile);
    // Logoff
    $logoff = filter_input(INPUT_GET, 'sair', FILTER_DEFAULT); // Caso o usuário deseje sair.
    if (isset($logoff) && $logoff == 'true'): // verifica  se é verdadeiro
        session_destroy(); // Sai da sessão
        header("Location: ./"); // volta pra página inicial.
    endif;

    echo '<a href="?sair=true">Sair</a>';
    var_dump($_SESSION);
    echo $accessToken;  // O ID do usuário gerado aqui, deve ser inserido no banco, pra futuras autenticações.
    echo "<br>";
    echo "<br>";
    echo $loginUrl;
    echo "<br>";
    echo "<br>";
    var_dump($_SESSION);

}else {  // ### Fazendo o login do usuário
    $loginUrl = $Login->getLoginUrl('http://localhost/eventstudy/pagina_inicial.php', $permissions); //Redirecionando pra página do app
    echo '<a href="' . $loginUrl . '">Entrar com facebook</a>';
    echo $accessToken;  // O ID do usuário gerado aqui, deve ser inserido no banco, pra futuras autenticações.
    echo "<br>";
    echo "<br>";
    echo $loginUrl;
    echo "<br>";
    echo "<br>";
    var_dump($_SESSION); // OBS :  Não é o ID no facebook, é o ID gerado pela API, no caso deve-se por ela no banco.
}
 ?>
