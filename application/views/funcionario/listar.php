<div class='titulo_page'>Listagem de Funcionários</div>
<div class = 'listar_funcionario'>
	<table cellspacing="1" id='myTable' class="tablesorter">
		<thead>
			<tr>
				<th>Código</th>
				<th>Nome</th>
				<th>CPF</th>				
			</tr>
		</thead> 
		<tbody id = "conteudo_grid">
			<script type="text/javascript">
				function RedirecionamentoHome(){
					$.blockUI({ message: '<h1>Ocorreu um erro no servidor<br />Redirecionando...</h1>' });

					// Efetuar o redirecionamento
					setTimeout(
						function(){
							window.location = "<?php echo BASE_URL;?>"
						},
						4000
					);					
				}

				$(document).ready(function(){
					$.blockUI({ message: '<h1>Carregando os dados...</h1>' });

					var Url = "<?php echo BASE_URL;?>/funcionario/montaGrid";
					var Funcionarios;
					var Grid;

					$.ajax({
						type: "get",
						url: Url,
						dataType: 'json',
						success: function(retorno){
							if(retorno.success){
								
								Funcionarios = retorno.Funcionarios;

								//console.log(Funcionarios);
								Grid = "";

								for(Reg in Funcionarios){
									Grid += "<tr>";
									Grid += "<td>"+Funcionarios[Reg].FuncionarioId+"</td>";
									Grid += "<td>"+Funcionarios[Reg].Nome+"</td>";
									Grid += "<td>"+Funcionarios[Reg].Cpf+"</td>";
									Grid += "</tr>";
								}

								$("#conteudo_grid").html(Grid);

							    $("#myTable").tablesorter({ 
							        // sort on the first column and third column, order asc 
							        sortList: [[0,0]],
							        widgets: ['zebra'],
							        headers: { 
							            5: { 
							                sorter: false
							            }
							        }
							    }); 

								$.unblockUI();	
							}
							else{
								RedirecionamentoHome();
							}
						},
						error: function(){
							RedirecionamentoHome();
						}
					});
				});
			</script>
		</tbody>
	</table>
</div>