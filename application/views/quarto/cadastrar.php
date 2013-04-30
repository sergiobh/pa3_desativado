<html>
<head>
	<link rel = "stylesheet" type = "text/css" href = "../../../web/css/estilo.css"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script language = "javascript" src = "../../../web/js/scripts.js"></script>	
</head>
<div>
Estamos na view quarto/cadastrar
<?php
	echo '<br /><pre>';
?>

<body>

<center><h1> CADASTRO DE QUARTOS </h1><center>

	<form action = <?php echo BASE_URL;?>/quarto/processar method = "post" onsubmit="return validaDados(this)">
		<center><table cellspacing = "10" border = '0'>
			<tr>
				<td>Andar:*</td><td><input id = 'nome' type = 'text' size = "50" name = 'andar' descricao = 'andar' obrigatorio = 'sim' id = "nome" /></td>
			</tr>
			<tr>
				<td>Identificação:</td><td><input type = 'text' size = "20" name = 'identificacao' descricao = 'identificacao' obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td>Status:</td><td><input type = 'text' size = "20" name = 'status' descricao = 'status' obrigatorio = 'sim' /></td>
			</tr>
			
			<tr>
				<td><input type = 'submit' value = 'Enviar' /></td>
			</tr>
		</table>
	</form></center>
</body>
</html>

</div>