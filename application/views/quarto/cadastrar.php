<div class='titulo_page'>Cadastro de Quartos</div>
<div class = 'quarto_cadastrar'>
	<form class='formulario'>
		<table cellspacing = "10" border = '0'>
			<tr>
				<td>Andar:</td>
				<td><input type = 'text' maxlength = '10' id='Andar' name = 'Andar' descricao = 'Andar'  obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td>Identificação:</td>
				<td><input type = 'text' maxlength = '10' id='Identificacao' name = 'identificacao' descricao = 'Identificação'  obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<div class='retorno_ajax'></div>
					<input class='botao_submit' type = 'button' value = 'Enviar' />
					<input class='botao_reset' type = 'reset' value = 'Limpar' />
				</td>
			</tr>
		</table>
	</form>
	<script type="text/javascript">
		$(document).ready(function(){
		
			// Função para o click de cadastro
			$('.botao_submit').click(function(){

				// Validação do formulário padrão
				if(! validaDados2('formulario')){
					return false;
				}

				// Declaração de variaveis
				var Andar 			= $("#Andar").val();
				var Identificacao 	= $("#Identificacao").val();

				// Executa o POST usando metodo AJAX e retorando Json
				var Url				= '<?php echo BASE_URL;?>/quarto/salvarCadastro';

				var data 			= 'Andar='+Andar+'&Identificacao='+Identificacao;

				$.blockUI({ message: '<h1>Salvando os dados...</h1>' });

				$.ajax({
					type: "POST",
					url: Url,
					data: data,
					dataType: 'json',
					success: function(retorno){
						if(retorno.success){
				
							$.blockUI({ message: '<h3>'+retorno.msg+'</h3>' });

							// Efetuar o redirecionamento
							setTimeout(
								function(){
									window.location = "<?php echo BASE_URL;?>/quarto/listar"
								},
								4000
							);
						}
						else{
							// Se php retornou erro irá salvar o retorno da div "retorno"
							$('.retorno_ajax').html(retorno.msg);
							$.unblockUI();
						}
					},
					error: function(){
						$('.retorno_ajax').html('Ocorreu um erro no servidor. Tentar novamente!');
						$.unblockUI();
					}
				});
			});	
		});
	</script>
</div>