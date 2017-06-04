<?php 


$url = 'https://sistemas.faculdadeguararapes.edu.br/hub/fg/sicoe/site/coex';

$html = file_get_contents($url);

preg_match_all('/<a href="(.*?)"/',$html,$matches);

print_r($matches);



?>