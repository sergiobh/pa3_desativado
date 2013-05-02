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
	<form action = <?php echo BASE_URL;?>/funcionario/processar method = "post" onsubmit="return validaDados(this)">
		<table cellspacing = "10" border = '0'>
			<tr>
				<td>Nome:</td><td><input id = 'nome' type = 'text' size = '40' maxlength = '40' name = 'nome' descricao = 'nome' obrigatorio = 'sim'/></td>
			</tr>
			<tr>
				<td>CPF:</td><td><input type = 'text' size = '11' maxlength = '11' name = 'cpf' descricao = 'cpf' obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td>Senha:</td><td><input type = 'password' maxlength = '10' name = 'tel' descricao = 'tel' obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td><input type = 'submit' value = 'Enviar' /></td>
			</tr>
		</table>
	</form>
</body>
</html>

</div>