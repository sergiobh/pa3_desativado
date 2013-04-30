<html>
<head>
	<link rel = "stylesheet" type = "text/css" href = "../../../web/css/estilo.css"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script language = "javascript" src = "../../../web/js/scripts.js"></script>	
</head>

<div>
Estamos na view funcionario/cadastrar
<?php
	echo '<br /><pre>';
?>

<body>
<center><h1> CADASTRAR FUNCIONARIOS </h1><center>
	<form action = <?php echo BASE_URL;?>/funcionario/processar method = "post" onsubmit="return validaDados(this)">
		<center><table cellspacing = "10" border = '0'>
			<tr>
				<td>Nome:*</td><td><input id = 'nome' type = 'text' size = "50" name = 'nome' descricao = 'nome' obrigatorio = 'sim' id = "nome" /></td>
			</tr>
			<tr>
				<td>CPF:</td><td><input type = 'text' size = "9" name = 'cpf' descricao = 'cpf' obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td>Senha:</td><td><input type = 'password' name = 'tel' descricao = 'tel' obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td><input type = 'submit' value = 'Enviar' /></td>
			</tr>
		</table>
	</form></center>
</body>
</html>

</div>