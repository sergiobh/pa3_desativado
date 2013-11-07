<div class='titulo_page'>Edição de Leito</div>
<div class="leito_editar">
	<form class='formulario'>
		<input type="hidden" value="<?php echo $LeitoId;?>" id='LeitoId' />
		<table cellspacing = "10" border = '0'>
			<tr>
				<td class='col_titulo'>Quarto:</td>
				<td>
					<input type="text" readonly="readonly" id="Quarto">
					<input type="hidden" readonly="readonly" id="QuartoId">
				</td>
			</tr>
			<tr>
				<td>Identificação:</td>
				<td>
					<input type = 'text' maxlength = '10' id='Identificacao' name = 'identificacao' descricao = 'Identificação'  obrigatorio = 'sim' />
				</td>
			</tr>
			<tr>
				<td>Status:</td>
				<td>
					<select id='Status' descricao = 'Status' obrigatorio = 'sim'></select>
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

	<script type="text/javascript">
		$(document).ready(function(){

			$.blockUI({ message: '<h1>Carregando os dados...</h1>' });

			var Url = "<?php echo BASE_URL;?>/leito/getEditar/"+$('#LeitoId').val();

			$.ajax({
				type: "get",
				url: Url,
				dataType: 'json',
				success: function(retorno){
					if(retorno.success){
						var Leito 		= retorno.Leito;
						var Status 		= retorno.Status;
						var Dados 		= "";

						for(Reg in Status){
							Dados 		+= '<option value="'+Status[Reg].Status+'">'+Status[Reg].Nome+'</option>';
						}

						$("#Status").html(Dados);

						$("#Quarto").val(Leito.Quarto);
						$("#QuartoId").val(Leito.QuartoId);
						$("#Identificacao").val(Leito.Identificacao);
						$("#Status").val(Leito.Status);

						$.unblockUI();
					}
					else{
						$('.retorno_ajax').html('Ocorreu um erro no servidor. Favor recarregar a página!');
						$.unblockUI();
					}
				},
				error: function(){
					$('.retorno_ajax').html('Ocorreu um erro no servidor. Tentar novamente!');
					$.unblockUI();
				}
			});
	
			// Função para o click de cadastro
			$('.botao_submit').click(function(){

				// Validação do formulário padrão
				if(! validaDados2('formulario')){
					return false;
				}

				// Declaração de variaveis
				var LeitoId 	= $("#LeitoId").val();
				var QuartoId 	= $("#QuartoId").val();
				var Identificacao 	= $("#Identificacao").val();
				var Status		= $("#Status option:selected").val();

				// Executa o POST usando metodo AJAX e retorando Json
				var Url				= '<?php echo BASE_URL;?>/leito/salvarEdicao';

				var data 			= 'LeitoId='+LeitoId+'&QuartoId='+QuartoId+'&Status='+Status+'&Identificacao='+Identificacao;

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