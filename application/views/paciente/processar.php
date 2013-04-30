<div>
<?php
	echo 'PACIENTE CADASTRADO COM SUCESSO';
	echo '<br /><pre>';
	
	$nome = $_POST["nome"];
	$sexo = $_POST["sexo"];
	$logradouro = $_POST["logradouro"];
	$numero = $_POST["numero"];
	$complemento = $_POST["complemento"];
	$bairro = $_POST["bairro"];
	$cidade = $_POST["cidade"];
	$estado = $_POST["estado"];
	
	echo($nome).'</br>';
	echo($sexo).'</br>';
	echo($logradouro).'</br>';
	echo($numero).'</br>';
	echo($complemento).'</br>';
	echo($bairro).'</br>';
	echo($cidade).'</br>';
	echo($estado).'</br>';
	
?>