<div class='titulo_page'>Cadastro de Pacientes</div>
<div class = 'painel_pacientes'>
	<form class='formulario'>
		<table cellspacing = "10" border = '0'>
			<tr>
				<td>Nome:</td>
				<td><input id = 'nome' type = 'text' maxlength = '100' name = 'nome' descricao = 'nome' obrigatorio = 'sim' /></td>
				<td></td>
			</tr>
			<tr>
				<td>Plano:</td>
				<td>
					<select name="tipo" descricao = "plano" obrigatorio = 'sim'>
						<option value="-1">--- Selecione ---</option>
						<option value="1">Apartamento</option>
						<option value="2">Enfermária</option>
					</select>
				</td>
				<td></td>
			</tr>
			<tr>
				<td>Sexo:</td>
				<td>
					<select name="sexo" id='sexo' descricao = "sexo" obrigatorio = 'sim'>
						<option value="-1">--- Selecione ---</option>
						<option value="1">Masculino</option>
						<option value="2">Feminino</option>
					</select>
				</td>
				<td></td>
			</tr>
			<tr>
				<td>Cpf:</td>
				<td><input type = 'text' maxlength = '11' name = 'cpf' id='cpf' descricao = 'cpf' obrigatorio = 'sim' /></td>
				<td></td>
			</tr>
			<tr>
				<td>Logradouro:</td>
				<td><input type = 'text' maxlength = '50' name = 'logradouro' id='logradouro' descricao = 'logradouro' obrigatorio = 'sim' /></td>
				<td></td>
			</tr>
			<tr>
				<td>Número:</td>
				<td><input type = 'text' maxlength = '10' name = 'numero' id='numero' descricao = 'numero' obrigatorio = 'sim' /></td>
				<td></td>
			</tr>
			<tr>
				<td>Complemento:</td>
				<td><input type = 'text' maxlength = '10' name = 'complemento' id='complemento' descricao = 'complemento' obrigatorio = 'nao' /></td>
				<td></td>
			</tr>
			<tr>
				<td>Bairro:</td>
				<td><input type = 'text' maxlength = '40' name = 'bairro' id='bairro' descricao = 'bairro' obrigatorio = 'sim' /></td>
				<td></td>
			</tr>
			<tr>
				<td>Cidade:</td>
				<td><input type = 'text' maxlength = '40' name = 'cidade' id='cidade' descricao = 'cidade' obrigatorio = 'sim' /></td>
				<td></td>
			</tr>
			<tr>
				<td>Estado:</td>
				<td><input type = 'text' maxlength = '2' name = 'estado' id='estado' descricao = 'estado' obrigatorio = 'sim' /></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Contatos:</td>
				<td><input class='add_telefone' type = 'button' value = 'Adicionar' /></td>
				<td></td>
			</tr>
			<tr class='tr_botoes'>
				<td></td>
				<td colspan="2">
					<div class='retorno_ajax'></div>
					<input class='botao_submit' type = 'button' value = 'Enviar' />
					<input class='botao_reset' type = 'reset' value = 'Limpar' />
				</td>
			</tr>
		</table>
	</form>
	<script type="text/javascript">
		var QtdTelefone = 0;

		function AddTelefone(){
			QtdTelefone++;

			var AddTelefone = "<tr class='linha_telefone linha_telefone"+QtdTelefone+"'><td>Telefone"+QtdTelefone+":</td><td><input type = 'text' maxlength = '14' name = 'telefone"+QtdTelefone+"' descricao = 'telefone"+QtdTelefone+"' class='telefone' id = 'telefone"+QtdTelefone+"' obrigatorio = 'sim' /></td><td><input class='del_telefone' onclick='DelTelefone("+QtdTelefone+")' type = 'button' value = 'Remover' /></td></tr>";

			$(".tr_botoes").before(AddTelefone);

			$('.telefone').mask("(99)9999-9999");
		}

		function DelTelefone(Telefone){
			var Qtd = $(".linha_telefone").size();

			if(Qtd > 1){
				$(".linha_telefone"+Telefone).remove();
			}
			else{
				$('.retorno_ajax').html('Não foi possível remover, campo telefone obrigatório!');

				setTimeout(
					function(){
						$('.retorno_ajax').html('');
					},
					4000
				);

			}			
		}

		$(document).ready(function(){

			$("#cpf").mask("999.999.999-99");

			AddTelefone();

			$('.add_telefone').click(function(){
				AddTelefone();				
			});

			// Função para o click de cadastro
			$('.botao_submit').click(function(){

				// Validação do formulário padrão
				if(! validaDados2('formulario')){
					return false;
				}

				// Declaração de variaveis
				var Nome 			= $("#nome").val();
				var Tipo 			= $("#tipo").val();
				var Sexo 			= $("#sexo").val();
				var Cpf 			= $("#cpf").val();
				var Logradouro		= $("#logradouro").val();
				var Numero  		= $("#numero").val();
				var Complemento 	= $("#complemento").val();
				var Bairro  		= $("#bairro").val();
				var Cidade  		= $("#cidade").val();
				var Estado  		= $("#estado").val();
				
				// criar variavel para enviar o post de telefone





				// Executa o POST usando metodo AJAX e retorando Json
				var Url				= '<?php echo BASE_URL;?>/paciente/salvarCadastro';

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