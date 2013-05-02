<html>
<head>
	<link rel = "stylesheet" type = "text/css" href = "../../../web/css/estilo.css"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script language = "javascript" src = "../../../web/js/scripts.js"></script>	
</head>
<div class = 'leito_cadastrar'>
Estamos na view leito/cadastrar
<?php
	echo '<br /><pre>';
?>
<body>
	<form action = <?php echo BASE_URL;?>/leito/processar method = "post" onsubmit="return validaDados(this)">
		<table cellspacing = "10" border = '0'>
			<tr>
				<td>Quarto:</td><td>
					<select id='quartoId' name = 'quartoid' descricao = 'QuartoId' obrigatorio = 'sim'>
						<option value="">--- Selecione ---</option>
						<option value="1">Quarto1</option>
						<option value="2">Quarto2</option>
						<option value="3">Quarto3</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Identificação:</td><td><input type = 'text' size = '10' maxlength = '10' name = 'identificacao' /></td>
			</tr>
			<tr>
				<td>Status:</td><td>
					<select name='status' descricao = 'status'>
						<option value="">--- Selecione ---</option>
						<option value='1'>Ativo</option>
						<option value='2'>Em arrumação</option>
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