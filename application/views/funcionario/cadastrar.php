<div class='titulo_page'>Cadastro de Funcionário</div>
<div class = 'funcionario_cadastrar'>
	<form class='formulario'>
		<table cellspacing = "10" border = '0'>
			<tr>
				<td>Nome:</td>
				<td><input type = 'text' maxlength = '40' id='Nome' name = 'nome' descricao = 'Nome'  obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td>CPF:</td>
				<td><input type = 'text' maxlength = '11' id='Cpf' name = 'cpf' descricao = 'Cpf'  obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td>Grupo:</td>
				<td><select id='GrupoId' name = 'grupoid' descricao = 'Grupo'  obrigatorio = 'sim' /></td>
			</tr>
			<tr>
				<td>Senha:</td>
				<td><input type = 'password' maxlength = '10' id='Senha' name = 'senha' descricao = 'Senha'  obrigatorio = 'sim' /></td>
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

			carregarGrupoUsuario();
		
			// Função para o click de cadastro
			$('.botao_submit').click(function(){

				// Validação do formulário padrão
				if(! validaDados2('formulario')){
					return false;
				}

				// Declaração de variaveis
				var Nome 		= $("#Nome").val();
				var Cpf 		= $("#Cpf").val();
				var Senha 		= $("#Senha").val();
				var GrupoId 	= $("#GrupoId").val();

				// Executa o POST usando metodo AJAX e retorando Json
				var Url				= '<?php echo BASE_URL;?>/funcionario/salvarCadastro';

				var data 			= {'Nome':Nome,'Cpf':Cpf,'GrupoId':GrupoId,'Senha':Senha};

				$.blockUI({ message: '<h1>Salvando os dados...</h1>' });

				$.ajax({
					type: "post",
					url: Url,
					data: data,
					dataType: 'json',
					success: function(retorno){
						if(retorno.success){
				
							$.blockUI({ message: '<h3>'+retorno.msg+'</h3>' });

							// Efetuar o redirecionamento
							setTimeout(
								function(){
									window.location = "<?php echo BASE_URL;?>/funcionario/listar"
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

		function carregarGrupoUsuario(){
				$.blockUI({ message: '<h3>Carregando lista de Grupos</h3>' });

				var Url = "<?php echo BASE_URL;?>/grupo/listarcombobox";

				$.ajax({
					type: "get",
					url: Url,
					dataType: 'json',
					success: function(retorno){
						if(retorno.success){
							alimentaComboBox(retorno.Grupos);
							$.unblockUI();
						}
						else{
							// Se php retornou erro irá salvar o retorno da div "retorno"
							$('.retorno_ajax').html("Ocorreu um erro no sistema, recarregue a página!");
							$.unblockUI();
						}
					},
					error: function(){
						$('.retorno_ajax').html('Ocorreu um erro no servidor. Tentar novamente!');
						$.unblockUI();
					}
				});
		}

		function alimentaComboBox(Grupos){
			var Listagem = '<option value="-1">--- Selecione ---</option>';

			for(i in Grupos){
				Listagem += '<option value="'+Grupos[i].GrupoId+'">'+Grupos[i].Nome+'</option>';				
			}

			$('#GrupoId').html(Listagem);
		}
	</script>



	<?php /*
		<form action = <?php echo BASE_URL;?>/funcionario/processar method = "post" onsubmit="return validaDados(this)">
	*/ ?>
</div>