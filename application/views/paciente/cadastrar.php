<html>
<head>
	<link rel = "stylesheet" type = "text/css" href = "../../../web/css/estilo.css"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script language = "javascript" src = "../../../web/js/scripts.js"></script>	
</head>

<div>
Estamos na view paciente/cadastrar
<?php
	echo '<br /><pre>';
?>

<body>

<center><h1> CADASTRO DE PACIENTES </h1><center>

	<form action = <?php echo BASE_URL;?>/paciente/processar method = "post" onsubmit="return validaDados(this)">
		<center><table cellspacing = "10" border = '0'>
			<tr>
				<td>Nome:*</td><td><input id = 'nome' type = 'text' size = "50" name = 'nome' descricao = 'nome' obrigatorio = 'sim' id = "nome" /></td>
			</tr>
			<tr>
				<td>Sexo:</td><td>
					<select name="sexo" descricao = "sexo">
						<option value="">--- Selecione ---</option>
						<option value="masc">Masculino</option>
						<option value="fem">Feminino</option>
					</select>
				</td>
			</tr>	
			<tr>
				<td>Logradouro:</td><td><input type = 'text' size = "30" name = 'logradouro' descricao = 'logradouro' obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td>Número:</td><td><input type = 'text' size = "5 "name = 'numero' descricao = 'numero' obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td>Complemento:</td><td><input type = 'text' size = "10" name = 'complemento' descricao = 'complemento' obrigatorio = 'nao' /></td>
			</tr>
			<tr>
				<td>Bairro:</td><td><input type = 'text' size = "15" name = 'bairro' descricao = 'bairro' obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td>Cidade:</td><td><input type = 'text' size = "20" name = 'cidade' descricao = 'cidade' obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td>Estado:</td><td><input type = 'text' size = "20" name = 'estado' descricao = 'estado' obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td>Tipo:</td><td><input type = 'text' size = "20" name = 'tipo' descricao = 'tipo' obrigatorio = 'nao' /></td>
			</tr>
			<tr>
				<td>Status:</td><td><input type = 'text' size = "20" name = 'status' descricao = 'status' obrigatorio = 'nao' /></td>
			</tr>	
			<tr>
				<td><input type = 'submit' value = 'Enviar' /></td>
			</tr>
		</table>
	</form></center>
</body>
</html>

</div>