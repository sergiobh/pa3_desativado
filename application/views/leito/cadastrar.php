<div class='leito_cadastrar'>
Estamos na view leito/cadastrar
<?php
	echo '<br /><pre>';

?>
<form>
	<select id="QuartoId">
		<option value="-1">.:: Selecione ::.</option>
		<option value="1">Quarto1</option>
		<option value="2">Quarto2</option>
		<option value="3">Quarto3</option>
	</select>

	<input type="text" id='Identificacao' />

	<input type="button" id='botao_submit' value='Cadastrar' />
	<input type="reset"  value="Limpar">
</form>

<div class='retorno'></div>

<script type="text/javascript">
$(document).ready(function(){
	
	// Função para o click de cadastro
	$('#botao_submit').click(function(){
		// Declaração de variaveis
		var Identificacao 	= $("#Identificacao").val();
		var QuartoId		= $("#QuartoId option:selected").val();


		// Criar regras de validação aqui!!!!
			// Validar de campo Identificação está vazio
	
	
			// Se entrar é que não selecionou o campo corretamente
			if(QuartoId == -1){
				return false;
			}



		// Executa o POST usando metodo AJAX e retorando Json
		var Url		= '<?php echo BASE_URL;?>/leito/salvarCadastro';

		var data 	= 'QuartoId='+QuartoId+'&Identificacao='+Identificacao;

		$.blockUI({ message: '<h1>Salvando os dados...</h1>' });

		$.ajax({
			type: "POST",
			url: Url,
			data: data,
			dataType: 'json',
			success: function(retorno){
				if(retorno.success){
					// Se retorno do php Deu OK
					//$('.retorno').html(retorno.msg);
		
					$.blockUI({ message: '<h3>'+retorno.msg+'</h3>' });

					// Efetuar o redirecionamento
					setTimeout(
						function(){
							window.location = "<?php echo BASE_URL;?>/leito/listar"
						},
						4000
					);
				}
				else{
					// Se php retornou erro irá salvar o retorno da div "retorno"
					$('.retorno').html(retorno.msg);
					$.unblockUI();
				}
			},
			error: function(){
				$('.retorno').html('Ocorreu um erro no servidor!');
				$.unblockUI();
			}
		});
	});
	
});
</script>
</div>