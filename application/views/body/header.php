<div class='header_page'>
	<a href='<?php echo BASE_URL;?>'/paciente/processar>
		<div class='logo'></div>
	</a>
</div>
<div class='logout'>
	<?php
		if(isset($_SESSION['Funcionario']->FuncionarioId)){
			echo "<div class='nome'>Olá ".$_SESSION['Funcionario']->Nome.",</div>";
			echo "<div class='deslogar'>";
				?><a href='<?php echo BASE_URL;?>/funcionario/deslogar'>sair</a><?php
			echo "</div>";
		}
	?>
</div>