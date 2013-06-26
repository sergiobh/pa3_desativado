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

		$this->load->model('OcupacaoMod');
		$Pacientes 							= $this->OcupacaoMod->ListarPacientes();
		$Dados['Pacientes'] 				= $Pacientes;

		$Leitos 							= $this->OcupacaoMod->ListarLeitos();
		$Dados['Leitos'] 				= $Leitos;

		$Dados['View'] 						= 'ocupacao/desocupar';
		$this->load->view('body/index', $Dados);
	}
}