<div class='titulo_page'>Painel de Leitos</div>
<div class="home">
	<?php
		$Leito 		= '';
		$Quarto 	= '';
		$Andar		= '';
		//$i = 1;
		$FecharDiv  = false;

		foreach($Leitos as $Registro) {
//echo '<br />foreach = '.$i++;
			if($Andar != $Registro->Andar){
//echo '<br />Andar diferente: '.$Andar.' e '.$Registro->Andar;
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
//echo '<br />Quarto diferente: '.$Quarto.' e '.$Registro->Quarto;
				if($Quarto != ''){
					echo '</div>';
				}

				echo '<div class="home_quarto">';
				echo '<div class="home_quarto_item">Quarto: '.$Registro->Quarto.'</div>';

				$Quarto 	= $Registro->Quarto;
				$FecharDiv = true;
			}



			echo '<div class="home_leito_item '.$Registro->Status.'">Leito: '.$Registro->Leito.'</div>';





		}
			
		// Fecha div home_quarto
		echo '</div>';

		// Fecha div home_andar
		echo '</div>';
	?>
	<div class="clear"></div>
</div>