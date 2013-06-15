<div class='titulo_page'>Lista de Quartos</div>
<div class="quarto_listar">
	<?php
		$Andar		= '';
		$Quarto 	= '';

		$FecharDiv  = false;

		foreach($Quartos as $Registro) {

			if($Andar != $Registro->Andar){
				if($Andar != ''){
					echo '</div>';
				}

				echo '<div class="home_andar">';
				echo '<div class="home_andar_item">Andar: '.$Registro->Andar.'</div>';

				$Andar 	= $Registro->Andar;
				$Quarto = '';
				$FecharDiv = true;
			}

			echo '<a class="link_quarto" href="'.BASE_URL.'/quarto/editar/'.$Registro->QuartoId.'" title="Editar '.$Registro->Quarto.'" >';
				echo '<div class="home_leito_item '.$Registro->Status.'">Quarto: '.$Registro->Quarto.'</div>';
			echo '</a>';
		}			

		// Fecha div home_andar
		echo '</div>';
	?>
	<div class="clear"></div>

	<div class='legenda home_andar'>
		<div class='home_andar_item'>Legenda:</div>
		<div class='home_leito_item Liberado'>Liberado</div>	<div class="clear"></div>
		<div class='home_leito_item Ocupado'>Ocupado</div>	<div class="clear"></div>
		<div class='home_leito_item Desativado'>Desativado</div>	<div class="clear"></div>
	</div>

	<div class="clear"></div>	
</div>