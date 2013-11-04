<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grupo extends CI_Controller {

	public function listarcombobox(){

		$this->load->model('GrupoMod');
		$Grupos 							= $this->GrupoMod->Listar();
		$Dados['Grupos'] 					= $Grupos;
		$Dados['success']					= true;

		echo json_encode($Dados);
	}
}