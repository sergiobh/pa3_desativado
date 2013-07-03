<div class='titulo_page'>Lista de Leitos</div>
<div class="leito_listar">
	<?php
		$Leito 		= '';
		$Quarto 	= '';
		$Andar		= '';

		$FecharDiv  = false;

		if($Leitos){
			foreach($Leitos as $Registro) {

			if($Andar != $Registro->Andar){
				if($Andar != ''){
					echo '</div></div>';
				}

				echo '<div class="home_andar">';
				echo '<div class="home_andar_item">Andar: '.$Registro->Andar.'</div>';

				$Andar 	= $Registro->Andar;
				$Quarto = '';
				$FecharDiv = true;
			}


			if($Quarto != $Registro->Quarto){

				if($Quarto != ''){
					echo '</div>';
				}

				echo '<div class="home_quarto">';
				echo '<div class="home_quarto_item">Quarto: '.$Registro->Quarto.'</div>';

				$Quarto 	= $Registro->Quarto;
				$FecharDiv = true;
			}


			echo '<a class="link_leito" href="'.BASE_URL.'/leito/editar/'.$Registro->LeitoId.'" title="Editar '.$Registro->Leito.'" >';
				echo '<div class="home_leito_item '.$Registro->Status.'">Leito: '.$Registro->Leito.'</div>';
			echo '</a>';
		}
		}
			
		// Fecha div home_quarto
		echo '</div>';

		// Fecha div home_andar
		echo '</div>';
	?>
	<div class="clear"></div>

	<div class='legenda home_andar'>
		<div class='home_andar_item'>Legenda:</div>
		<div class='home_leito_item Liberado'>Liberado</div>	<div class="clear"></div>
		<div class='home_leito_item Arrumacao'>Arrumação</div>	<div class="clear"></div>
		<div class='home_leito_item Ocupado'>Ocupado</div>	<div class="clear"></div>
		<div class='home_leito_item Desativado'>Desativado</div>	<div class="clear"></div>
	</div>

	<div class="clear"></div>	
</div>