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
	<form action = <?php echo BASE_URL;?>/paciente/processar method = "post" onsubmit="return validaDados(this)">
		<table cellspacing = "10" border = '0'>
			<tr>
				<td>Nome:</td><td><input id = 'nome' type = 'text' size = '50' maxlength = '100' name = 'nome' descricao = 'nome' obrigatorio = 'sim' id = "nome" /></td>
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
				<td>Cpf:</td><td><input type = 'text' size = '11' maxlength = '11' name = 'cpf' descricao = 'cpf' obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td>Logradouro:</td><td><input type = 'text' size = '50' maxlength = '50' name = 'logradouro' descricao = 'logradouro' obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td>Número:</td><td><input type = 'text' size = '10' maxlength = '10' name = 'numero' descricao = 'numero' obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td>Complemento:</td><td><input type = 'text' size = '10' maxlength = '10' name = 'complemento' descricao = 'complemento' obrigatorio = 'nao' /></td>
			</tr>
			<tr>
				<td>Bairro:</td><td><input type = 'text' size = '40' maxlength = '40' name = 'bairro' descricao = 'bairro' obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td>Cidade:</td><td><input type = 'text' size = '40' maxlength = '40' name = 'cidade' descricao = 'cidade' obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td>Estado:</td><td><input type = 'text' size = '2' maxlength = '2' name = 'estado' descricao = 'estado' obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td>Telefone:</td><td><input type = 'text' size = '14' maxlength = '14' name = 'telefone' descricao = 'telefone' obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td>Tipo:</td><td>
					<select name="tipo" descricao = "tipo">
						<option value="">--- Selecione ---</option>
						<option value="1">teste1</option>
						<option value="0">teste2</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Status:</td><td>
					<select name="Status" descricao = "status">
						<option value="">--- Selecione ---</option>
						<option value="1">Ativo</option>
						<option value="0">Inativo</option>
					</select>
				</td>
			</tr>	
			<tr>
				<td><input type = 'submit' value = 'Enviar' /></td>
			</tr>
		</table>
	</form>
</body>
</div>
</html>
