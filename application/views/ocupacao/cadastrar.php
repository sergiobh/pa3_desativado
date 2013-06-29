<div class='titulo_page'>Cadastro de Ocupação</div>
<div class = 'ocupacao_cadastrar'>
	<form class='formulario'>
		<table cellspacing = "10" border = '0'>
			<tr>
				<td class='col_titulo'>Paciente:</td>
				<td>
					<select name = 'PacienteId' id='PacienteId' descricao = 'Paciente' obrigatorio = 'sim'>
						<option value="-1">--- Selecione ---</option>
						<?php if($Pacientes){ ?>
							<?php foreach($Pacientes as $Registro) { ?>
								<option value="<?php echo $Registro->PacienteId;?>"><?php echo $Registro->Paciente;?></option>';
							<?php } ?>
						<?php } ?>
					</select>
				</td>
			</tr>
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
				<td class='col_titulo'>Leito:</td>
				<td>
					<select name = 'leitoid' id='LeitoId' descricao = 'Leito' obrigatorio = 'sim'>
						<option value="-1">--- Selecione o leito ---</option>
					</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<div class='retorno_ajax'></div>
					<input class='botao_submit' type = 'button' value = 'Cadastrar' />
					<input class='botao_reset' type = 'reset' value = 'Limpar' />
				</td>
			</tr>
		</table>
	</form>


	<script type="text/javascript">
		$(document).ready(function(){

			$('#PacienteId').change(function(){
				var PacienteId 	= $(this).val();

				$('#QuartoId').html('<option value="-1">--- Selecione o quarto ---</option>');
				$('#LeitoId').html('<option value="-1">--- Selecione o leito ---</option>');

				if(PacienteId == -1){
					$('#AndarId').html('<option value="-1">--- Selecione o andar ---</option>');
				}
				else{
					var Url		= '<?php echo BASE_URL;?>/quarto/getAndar';
					var data 	= 'PacienteId='+PacienteId
									+'&Ocupacao=1'

					$.blockUI({ message: '<h1>Carregando os andares...</h1>' });

					$.ajax({
						type: "POST",
						url: Url,
						data: data,					
						success: function(retorno){
							$('#AndarId').html('<option value="-1">--- Selecione ---</option>' + retorno);
							$.unblockUI();
						},
						error: function(){
							$('.retorno_ajax').html('Ocorreu um erro no servidor. Favor recarregar a página!');
							$.unblockUI();
						}
					});
				}
			});


			// Função para carregar os Quartos
			$('#AndarId').change(function(){
				var Andar 	= $(this).val();

				$('#LeitoId').html('<option value="-1">--- Selecione o leito ---</option>');

				if(Andar == -1){
					$('#QuartoId').html('<option value="-1">--- Selecione o andar ---</option>');
				}
				else{
					var PacienteId = $('#PacienteId').val();

					var Url		= '<?php echo BASE_URL;?>/quarto/getQuartos';
					var data 	= 'Andar='+Andar
									+'&Ocupacao=1'
									+'&PacienteId='+PacienteId;

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

			// Função para carregar os Quartos
			$('#QuartoId').change(function(){
				var QuartoId 	= $(this).val();

				if(QuartoId == -1){
					$('#LeitoId').html('<option value="-1">--- Selecione o leito ---</option>');
				}
				else{
					var PacienteId = $('#PacienteId').val();


					var Url		= '<?php echo BASE_URL;?>/leito/getLeitos';
					var data 	= 'QuartoId='+QuartoId
									+'&Ocupacao=1'
									+'&PacienteId='+PacienteId;

					$.blockUI({ message: '<h1>Carregando os leitos...</h1>' });

					$.ajax({
						type: "POST",
						url: Url,
						data: data,		
						dataType: 'json',			
						success: function(retorno){
							
							if(retorno.success){
								var Opcoes = '';

								for (var i = 0; i < retorno.leitos.length; i++) {
									Opcoes  += "<option value="+retorno.leitos[i].LeitoId+">"+retorno.leitos[i].Leito+"</option>";
								}

								$('#LeitoId').html('<option value="-1">--- Selecione ---</option>' + Opcoes);
								$.unblockUI();
							}
							else{
								$('.retorno_ajax').html(retorno.msg);
								$.unblockUI();
							}
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
				var PacienteId 		= $("#PacienteId option:selected").val();
				var LeitoId			= $("#LeitoId option:selected").val();

				// Executa o POST usando metodo AJAX e retorando Json
				var Url				= '<?php echo BASE_URL;?>/Ocupacao/salvarCadastro';

				var data 			= 'LeitoId='+LeitoId+'&PacienteId='+PacienteId;

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
									window.location = "<?php echo BASE_URL;?>/paciente/painel"
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
