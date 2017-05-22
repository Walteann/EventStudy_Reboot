<?php
//### Iniciando configurações ###
session_start(); // Inicia a session
require_once 'Facebook/autoload.php'; // Importa o autoload.


//### Login da API do Facebook ###
$fb = new Facebook\Facebook([  // Instanciando classe facebook.
  'app_id' => '291865097928347', // ID da API (Apenas adm)
  'app_secret' => '89e6b4a112716e8fc7601bdd9924ce80', // Senha da API (Apenas adm)
  'default_graph_version' => 'v2.7',
  ]);


 ?>
