<div class='titulo_page'>Cadastro de Leitos</div>
<div class = 'leito_cadastrar'>
	<form class='formulario'>
		<table cellspacing = "10" border = '0'>
			<tr>
				<td class='col_titulo'>Andar:</td>
				<td>
					<select name = 'AndarId' id='AndarId' descricao = 'Andar' obrigatorio = 'sim'>
						<option value="-1">--- Selecione ---</option>
					</select>
				</td>
			</tr>

			<tr>
				<td class='col_titulo'>Quarto:</td>
				<td>
					<select name = 'quartoid' id='QuartoId' descricao = 'Quarto' obrigatorio = 'sim'>
						<option value="-1">--- Selecione o andar ---</option>
					</select>
				</td>
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
			// Funçao para carregar os Andares
			$.blockUI({ message: '<h1>Carregando os andares...</h1>' });

			var Url = '<?php echo BASE_URL;?>/quarto/getAndar';

			$.ajax({
				type: "get",
				url: Url,
				dataType: 'json',
				success: function(retorno){
					var Dados = "";

					if(retorno.success){
						var Andares = retorno.Andares;

						for(Reg in Andares){
							Dados += '<option value="'+Andares[Reg].Andar+'">'+Andares[Reg].Andar+'</option>';
						}

						$('#AndarId').html('<option value="-1">--- Selecione ---</option>' + Dados);
						$.unblockUI();
					}
					else{
						
						$('.retorno_ajax').html('Ocorreu um erro no servidor. Favor recarregar a página!');
						$.unblockUI();
					}
				},
				error: function(){
					$('.retorno_ajax').html('Ocorreu um erro no servidor. Favor recarregar a página!');
					$.unblockUI();
				}
			});

			// Função para carregar os Quartos
			$('#AndarId').change(function(){
				if($(this).val() == -1){
					$('#QuartoId').html('<option value="-1">--- Selecione o andar ---</option>');
				}
				else{
					var Andar 	= $(this).val();

					var Url		= '<?php echo BASE_URL;?>/quarto/getQuartos';
					var data 	= 'Andar='+Andar;

					$.blockUI({ message: '<h1>Carregando os quartos...</h1>' });

					$.ajax({
						type: "get",
						url: Url,
						data: data,
						dataType: 'json',		
						success: function(retorno){
							var Dados = "";

							if(retorno.success){
								var Quartos = retorno.Quartos;

								for(Reg in Quartos){
									Dados += '<option value="'+Quartos[Reg].QuartoId+'">'+Quartos[Reg].Quarto+'</option>';
								}

								$('#QuartoId').html('<option value="-1">--- Selecione ---</option>' + Dados);
								$.unblockUI();
							}
							else{
								$('.retorno_ajax').html('Ocorreu um erro no servidor. Favor recarregar a página!');
								$.unblockUI();
							}
						},
						error: function(){
							$('.retorno_ajax').html('Ocorreu um erro no servidor. Favor recarregar a página!');
							
							setTimeout(
								function(){
									$.unblockUI();
								},
								4000
							);
						}
					});
				}
			});

			// Função para o click de cadastro
			$('.botao_submit').click(function(){

				// Validação do formulário padrão
				if(! validaDados2('formulario')){
					return false;
				}

				// Declaração de variaveis
				var Identificacao 	= $("#Identificacao").val();
				var QuartoId		= $("#QuartoId option:selected").val();

				// Executa o POST usando metodo AJAX e retorando Json
				var Url				= '<?php echo BASE_URL;?>/leito/salvarCadastro';

				var data 			= 'QuartoId='+QuartoId+'&Identificacao='+Identificacao;

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