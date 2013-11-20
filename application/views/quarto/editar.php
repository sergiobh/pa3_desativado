<div class='titulo_page'>Edição de Quarto</div>
<div class="quarto_editar">
	<?php if($Quarto) { ?>
		<form class='formulario'>
			<table cellspacing = "10" border = '0'>
				<tr>
					<td class='col_titulo'>Andar:</td>
					<td>
						<input type="text" id="Andar" value="<?php echo $Quarto->Andar;?>" <?php echo ($Quarto->Status == '3') ? 'readonly="readonly"' : '';?> obrigatorio = 'sim' >
					</td>
				</tr>
				<tr>
					<td>Identificação:</td>
					<td>
						<input type = 'text' maxlength = '10' id='Identificacao' name = 'identificacao' descricao = 'Identificação'  obrigatorio = 'sim' value="<?php echo $Quarto->Identificacao;?>" />
					</td>
				</tr>
				<tr>
					<td>Status:</td>
					<td>
						<select id='Status' descricao = 'Status' obrigatorio = 'sim'>
							<?php if($Quarto->Status != '3') { ?>
								<?php foreach($Status as $Registro){ ?>
									<option value="<?php echo $Registro->Status;?>" <?php echo ($Quarto->Status == $Registro->Status) ? 'selected="selected"' : '';?>><?php echo $Registro->Nome;?></option>
								<?php } ?>
							<?php }else { ?>
								<option value="1" selected="selected">Ocupado</option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<div class='retorno_ajax'></div>
						<input class='botao_submit' type = 'button' value = 'Enviar' />
						<input class='botao_reset' type = 'reset' value = 'Cancelar' />
					</td>
				</tr>
			</table>
		</form>
	<?php } else{ ?>
		<div class=''>Quarto inválido!</div>
	<?php } ?>
	<script type="text/javascript">
		$(document).ready(function(){
		
			// Função para o click de cadastro
			$('.botao_submit').click(function(){

				// Validação do formulário padrão
				if(! validaDados2('formulario')){
					return false;
				}

				// Declaração de variaveis
				var QuartoId 	= <?php echo $Quarto->QuartoId;?>;
				var Andar 		= $("#Andar").val();
				var Identificacao 	= $("#Identificacao").val();
				var Status		= $("#Status option:selected").val();

				// Executa o POST usando metodo AJAX e retorando Json
				var Url				= '<?php echo BASE_URL;?>/quarto/salvarEdicao';

				var data 			= 'Andar='+Andar+'&QuartoId='+QuartoId+'&Status='+Status+'&Identificacao='+Identificacao;

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