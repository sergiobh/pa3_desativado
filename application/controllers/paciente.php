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

		/* Pode deletar */
		$this->load->model('PacienteMod');
		$Pacientes 						= $this->PacienteMod->FilaEspera();
		$Dados['Pacientes']				= $Pacientes;
		/* pode deletar */

		$Dados['View'] 					= 'paciente/consultar';
		$this->load->view('body/index', $Dados);
	}

	public function getPacientes(){
		$this->load->model('PacienteMod');
		$Pacientes 						= $this->PacienteMod->FilaEspera();

		echo 'Irei tratar esse objeto para retornar Json<br /><pre>';
		print_r($Pacientes);
	}
	
	public function processar(){
		$Dados['View'] 					= 'paciente/processar';
		//$this->load->view('body/index', $Dados);
		
		//$this->load->model('PacienteMod');
		
		
		
	}

}