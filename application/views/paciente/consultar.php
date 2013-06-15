
<div class='titulo_page'>Consulta de Pacientes</div>
<div class="paciente_consultar">
	<form class='formulario'>
		<table cellspacing = "10" border = '0'>
			<tr>
				<td>Cpf:</td>
				<td><input type = 'text' maxlength = '14' id='cpf' name = 'cpf' descricao = 'Cpf'  obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<div class='retorno_ajax'></div>
					<input class='botao_submit' type = 'button' value = 'Consultar' />
					<input class='botao_reset' type = 'reset' value = 'Limpar' />
				</td>
			</tr>
		</table>
	</form>

	<div id='Redirect' class='hide'></div>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#cpf").mask("999.999.999-99");

			$('.formulario').submit(function(){
				return false;
			});

			// Função para o click de cadastro
			$('.botao_submit').click(function(){

				var cpf = $("#cpf").val();

				cpf = cpf.replace('.','');
				cpf = cpf.replace('.','');
				cpf = cpf.replace('-','');

				if(!validaCPF(cpf)){
					$(".retorno_ajax").html('Cpf inválido, favor verificar!');
					return false;
				}

				// Executa o POST usando metodo AJAX e retorando Json
				var Url				= '<?php echo BASE_URL;?>/paciente/getPaciente';

				var data 			= 'Cpf='+cpf;

				var Html;

				$.blockUI({ message: '<h1>Consultando paciente...</h1>' });

				$.ajax({
					type: "POST",
					url: Url,
					data: data,
					dataType: 'json',
					success: function(retorno){
						if(retorno.success){
				
							$.blockUI({ message: '<h3>'+retorno.msg+'</h3>' });

							// Metodo se 
							if(retorno.url == 'editar'){
								/*
								/* Executa um post com o CPF do paciente
								*/
								var PacienteId = retorno.PacienteId;
								
								Html = "<form id='form_edit' action='<?php echo BASE_URL;?>/paciente/editar' method='POST'>";
								Html += "<input value='"+ PacienteId +"' name='PacienteId' />";
								Html += "</form>";

								$("#Redirect").html(Html);

								$("#form_edit").submit();
							}
							else{
								// Efetuar o redirecionamento
								$.blockUI({ message: '<h3>'+retorno.msg+'</h3>' });

								setTimeout(
									function(){
										window.location = "<?php echo BASE_URL;?>/paciente/cadastrar";
									},
									4000
								);
							}
						}
						else{
							// Se php retornou erro irá salvar o retorno da div "retorno"
							$.blockUI({ message: '<h3>'+retorno.msg+'</h3>' });

							setTimeout(
								function(){
									$.unblockUI();
								},
								4000
							);
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