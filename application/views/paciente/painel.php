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
				<?php foreach ($Pacientes as $Registro) { ?>
					<tr>
						<td><?php echo $Registro->Paciente;?></td>
						<td><?php echo $Registro->Andar;?></td>
						<td><?php echo $Registro->Quarto;?></td>
						<td><?php echo $Registro->Leito;?></td>
						<td><?php echo $Registro->DataCad.' '.$Registro->HoraCad;?></td>
						<td>
							<a href='<?php echo BASE_URL;?>/ocupacao/desocupar/<?php echo $Registro->OcupacaoId;?>'>
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
		
		//$("#myTable").tablesorter( {sortList: [[0,0], [1,0]]} ); 
		//$("#myTable").tablesorter(); 
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

<?php /*
		$('table > tbody > tr:odd').addClass('odd');

		$('table > tbody > tr').hover(function(){
			$(this).toggleClass('hover');
		});

		$('table').tablesorter({
			dateFormat: 'uk',
			headers: {
				0: {
					sorter: false
				},
				5: {
					sorter: false
				}
			}
		}).tablesorterPager({
			container: $('#pager')
		}).bind('sortEnd', function(){
			$('table > tbody > tr').removeClass('odd');
			$('table > tbody > tr:odd').addClass('odd');
		});
*/ ?>
	});
</script>


<?php //echo '<pre>';print_r($Pacientes); ?>