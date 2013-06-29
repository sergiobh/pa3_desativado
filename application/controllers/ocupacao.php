<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ocupacao extends CI_Controller {

	public function cadastrar()
	{
		$this->load->model('PacienteMod');
		$Pacientes 							= $this->PacienteMod->FilaEspera();

		$Dados['Pacientes'] 				= $Pacientes;
		$Dados['View'] 						= 'ocupacao/cadastrar';
		$this->load->view('body/index', $Dados);
	}

	public function desocupar(){

		$OcupacaoId							= $this->input->post("OcupacaoId");

		$this->load->model('OcupacaoMod');
		$this->OcupacaoMod->OcupacaoId 		= $OcupacaoId;
		$this->OcupacaoMod->BaixaOcupacao();
	}
}