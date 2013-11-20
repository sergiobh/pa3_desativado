<?php
class CriptografiaLib{
	public function Gerar($Senha){
		return md5($Senha);
	}
}
?>