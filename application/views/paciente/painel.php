<div class='titulo_page'>Painel de Pacientes</div>
<div class = 'painel_pacientes'>
	<table cellspacing="1" id='myTable' class="tablesorter">
		<thead>
			<tr>
				<th>Paciente</th>
				<th>Andar</th>
				<th>Quarto</th>
				<th>Leito</th>
				<th>Data</th>
				<th>Efetuar Baixa</th>
			</tr>
		</thead> 
		<tbody>
			<?php if($Pacientes){ ?>
				<?php $PossuiPaciente = true;?>
				<?php foreach ($Pacientes as $Registro) { ?>
					<tr>
						<td><?php echo $Registro->Paciente;?></td>
						<td><?php echo $Registro->Andar;?></td>
						<td><?php echo $Registro->Quarto;?></td>
						<td><?php echo $Registro->Leito;?></td>
						<td><?php echo $Registro->DataCad.' '.$Registro->HoraCad;?></td>
						<td>
							<a href='#' class='efetuaBaixa' OcupacaoId='<?php echo $Registro->OcupacaoId;?>'>
								<div class='botao_baixa'>Baixar</div>
							</a>
						</td>
					</tr>
				<?php } ?>
			<?php } ?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$(document).ready(function(){
	    
		<?php if(isset($PossuiPaciente)){?>
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
		<?php } ?>

		$('.efetuaBaixa').click(function(){
			var OcupacaoId 	= $(this).attr('OcupacaoId');

			var Url = "<?php echo BASE_URL;?>/ocupacao/desocupar";

			var data 		= 'OcupacaoId='+OcupacaoId;

			$.blockUI({ message: '<h1>Efetuando a baixa do leito...</h1>' });

			$.ajax({
				type: "POST",
				url: Url,
				data: data,
				dataType: 'json',
				success: function(retorno){
					$.unblockUI();

					if(retorno.success){
						if(confirm('Deseja efetuar baixa do Paciente?')){
							$.blockUI({ message: '<h1>Efetuando a baixa do Paciente...</h1>' });

							var Url2 		= "<?php echo BASE_URL;?>/paciente/efetuarBaixa";

							var data2 		= 'PacienteId='+retorno.PacienteId;

							$.ajax({
								type: "POST",
								url: Url2,
								data: data2,
								success: function(retorno){
									// Efetuar o redirecionamento
									setTimeout(
										function(){
											window.location = "<?php echo BASE_URL;?>/paciente/painel"
										},
										1000
									);

									$.unblockUI();
								},
								error: function(){
									$('.retorno_ajax').html('Ocorreu um erro no servidor. Favor recarregar a página!');
									$.unblockUI();
								}
							});							

						}
						else{
							// Efetuar o redirecionamento
							setTimeout(
								function(){
									window.location = "<?php echo BASE_URL;?>/paciente/painel"
								},
								1000
							);

							$.unblockUI();
						}
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
		});

	});
</script>