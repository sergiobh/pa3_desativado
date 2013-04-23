<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paciente extends CI_Controller {

	public function cadastrar()
	{

		$Dados['View'] 					= 'paciente/cadastrar';
		$this->load->view('body/index', $Dados);
	}

	public function painel(){

		$this->load->model('PacienteMod');
		$Pacientes 						= $this->PacienteMod->Listar();
		$Dados['Pacientes'] 			= $Pacientes;

		$Dados['View'] 					= 'paciente/painel';
		$this->load->view('body/index', $Dados);
	}

	public function consultar(){

		$Dados['View'] 					= 'paciente/consultar';
		$this->load->view('body/index', $Dados);
	}
}