<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paciente extends CI_Controller {

	public function cadastrar()
	{
		$Dados['Script'][]				= 'jquery/jquery.maskedinput.js';

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
		/*$this->load->model('PacienteMod');
		$Pacientes 						= $this->PacienteMod->FilaEspera();
		$Dados['Pacientes']				= $Pacientes;*/
		/* pode deletar */

		/*
		/* Adicionar um script Javascript somente neste HEADER
		*/
		$Dados['Script'][]				= 'jquery/jquery.maskedinput.js';

		$Dados['View'] 					= 'paciente/consultar';
		$this->load->view('body/index', $Dados);
	}

	public function getPacientes(){
		$this->load->model('PacienteMod');
		$Pacientes 						= $this->PacienteMod->FilaEspera();

		echo 'Irei tratar esse objeto para retornar Json<br /><pre>';
		print_r($Pacientes);
	}
	
	public function getPaciente(){
		$Cpf 			= $this->input->post("Cpf");

		$this->load->model('PacienteMod');
		$this->PacienteMod->Cpf			= $Cpf;
		$this->PacienteMod->getPaciente();
	}

	public function processar(){
		$Dados['View'] 					= 'paciente/processar';
		//$this->load->view('body/index', $Dados);
		
		//$this->load->model('PacienteMod');		
	}

	public function editar(){
		$PacienteId 					= $this->input->post("PacienteId");		

		$this->load->model('PacienteMod');
		$this->PacienteMod->PacienteId	= $PacienteId;
		$Paciente 						= $this->PacienteMod->getDadosPaciente();

		$Dados['Script'][]				= 'jquery/jquery.maskedinput.js';

		$Dados['View'] 					= 'paciente/editar';
		$this->load->view('body/index', $Dados);
	}

}