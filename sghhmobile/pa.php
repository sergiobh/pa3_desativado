<?php
 
//CODIGO HTML: <td ALIGN="CENTER" class="fundoPadraoBClaro2">11/06/2010</td><td ALIGN="right" class="fundoPadraoBClaro2">1,8117</td>
 
 
//URL DO SITE A SER CAPTURADO
if($_GET["tipo"]=="lista"){
$url = 'http://www.sghh.com/leito/getListar';
} else if($_GET["tipo"]=="leito"){
$url = 'http://www.sghh.com/leito/getEditar/'.$_GET["leitoid"];
}
 
//PEGAR TODO CÓDIGO HTML PARA UMA VARIAVEL STRING
$site = file_get_contents($url);

 
print $site ;
 
?>