<div class='titulo_page'>Cadastro de Leitos</div>
<div class = 'leito_cadastrar'>
	<form class='formulario'>
		<table cellspacing = "10" border = '0'>
			<tr>
				<td class='col_titulo'>Andar:</td>
				<td>
					<select name = 'AndarId' id='AndarId' descricao = 'Andar' obrigatorio = 'sim'>
						<option value="-1">--- Selecione ---</option>
						
						<?php if($Andar){ ?>
							<?php foreach($Andar as $Registro) { ?>
								<option value="<?php echo $Registro->Andar;?>"><?php echo $Registro->Andar;?></option>';
							<?php } ?>
						<?php } ?>
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
						type: "POST",
						url: Url,
						data: data,					
						success: function(retorno){
							$('#QuartoId').html('<option value="-1">--- Selecione ---</option>' + retorno);
							$.unblockUI();
						},
						error: function(){
							$('.retorno_ajax').html('Ocorreu um erro no servidor. Favor recarregar a página!');
							$.unblockUI();
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