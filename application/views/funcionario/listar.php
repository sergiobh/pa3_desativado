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
		<tbody>
			<?php if($Funcionarios){ ?>
				<?php foreach ($Funcionarios as $Registro) { ?>
					<tr>
						<td><?php echo $Registro->FuncionarioId;?></td>
						<td><?php echo $Registro->Nome;?></td>
						<td><?php echo $Registro->Cpf;?></td>					
					</tr>
				<?php } ?>
			<?php } ?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$(document).ready(function(){		
	
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

	});
</script>


<?php //echo '<pre>';print_r($Pacientes); ?>

