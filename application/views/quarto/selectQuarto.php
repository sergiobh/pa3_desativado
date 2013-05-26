<?php 
	if($Quartos){
		foreach ($Quartos as $Registro) {
			echo '<option value="'.$Registro->QuartoId.'">'.$Registro->Quarto.'</option>';
		}
	}
?>