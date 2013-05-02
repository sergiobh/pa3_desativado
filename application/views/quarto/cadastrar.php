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
	<form action = <?php echo BASE_URL;?>/quarto/processar method = "post" onsubmit="return validaDados(this)">
		<table cellspacing = "10" border = '0'>
			<tr>
				<td>Andar:</td><td><input id = 'quarto' type = 'text' size = '10' maxlength = '10' name = 'andar' descricao = 'andar' obrigatorio = 'sim' id = "nome" /></td>
			</tr>
			<tr>
				<td>Identificação:</td><td><input type = 'text' size = '10' maxlength = '10' name = 'identificacao' descricao = 'identificacao' obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td>Status:</td><td>
					<select name="sexo" descricao = 'status'>
						<option value="">--- Selecione ---</option>
						<option value='1'>Ativo</option>
						<option value='0'>Inativo</option>
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

