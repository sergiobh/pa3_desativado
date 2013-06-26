<?php 
	if($Andar){
		foreach ($Andar as $Registro) {
			echo '<option value="'.$Registro->Andar.'">'.$Registro->Andar.'</option>';
		}
	}
?>