<?php

session_start();

unset($_SESSION['login']);
unset($_SESSION['email']);
header('Location: pagina_inicial.php');

?>