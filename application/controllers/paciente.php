<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paciente extends CI_Controller {

	public function cadastrar()
	{
		$this->CheckLogado();

		$Dados['Script'][]				= 'jquery/jquery.maskedinput.js';

		$Dados['View'] 					= 'paciente/cadastrar';
		$this->load->view('body/index', $Dados);
	}

	public function salvarCadastro(){

		$Bairro 						= $this->input->post("Bairro");
		$Cidade 						= $this->input->post("Cidade");
		$Complemento 					= $this->input->post("Complemento");
		$Cpf 							= $this->input->post("Cpf");
		$Estado 						= strtoupper($this->input->post("Estado"));
		$Logradouro 					= $this->input->post("Logradouro");
		$Nome 							= $this->input->post("Nome");
		$Numero 						= $this->input->post("Numero");
		$QtdTelefone 					= $this->input->post("QtdTelefone");
		$Sexo 							= $this->input->post("Sexo");
		$Telefone 						= $this->input->post("Telefone");
		$Tipo 							= $this->input->post("Tipo");

		$this->load->model('PacienteMod');
		$this->PacienteMod->Bairro		= $Bairro;
		$this->PacienteMod->Cidade		= $Cidade;
		$this->PacienteMod->Complemento	= $Complemento;
		$this->PacienteMod->Cpf			= $Cpf;
		$this->PacienteMod->Estado		= $Estado;
		$this->PacienteMod->Logradouro	= $Logradouro;
		$this->PacienteMod->Nome		= $Nome;
		$this->PacienteMod->Numero		= $Numero;
		//$this->PacienteMod->QtdTelefone	= $QtdTelefone;
		$this->PacienteMod->Sexo		= $Sexo;
		$this->PacienteMod->Telefone	= $Telefone;
		$this->PacienteMod->Tipo		= $Tipo;

		$Pacientes 						= $this->PacienteMod->SalvarCadastro();
	}

	public function painel(){
		$this->CheckLogado();


		$this->load->model('PacienteMod');
		$Pacientes 						= $this->PacienteMod->Listar();
		$Dados['Pacientes'] 			= $Pacientes;

		$Dados['View'] 					= 'paciente/painel';
		$this->load->view('body/index', $Dados);
	}

	public function consultar(){
		$this->CheckLogado();

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
		$this->CheckLogado();

		$PacienteId 					= $this->input->post("PacienteId");

		if(!is_numeric($PacienteId) || $PacienteId == ''){
			header('Location: '.BASE_URL);
			exit;
		}


		$this->load->model('PacienteMod');
		$this->PacienteMod->PacienteId	= $PacienteId;
		$Paciente 						= $this->PacienteMod->getDadosPaciente();

		$Dados['Paciente'] 				= $Paciente;

		$Dados['Script'][]				= 'jquery/jquery.maskedinput.js';

		$Dados['View'] 					= 'paciente/editar';
		$this->load->view('body/index', $Dados);
	}

	public function SalvarEdicao(){
		$PacienteId 					= $this->input->post("PacienteId");
		$Bairro 						= $this->input->post("Bairro");
		$Cidade 						= $this->input->post("Cidade");
		$Complemento 					= $this->input->post("Complemento");
		$Cpf 							= $this->input->post("Cpf");
		$Estado 						= strtoupper($this->input->post("Estado"));
		$Logradouro 					= $this->input->post("Logradouro");
		$Nome 							= $this->input->post("Nome");
		$Numero 						= $this->input->post("Numero");
		$QtdTelefone 					= $this->input->post("QtdTelefone");
		$Sexo 							= $this->input->post("Sexo");
		$Status 						= $this->input->post("Status");
		$Telefone 						= $this->input->post("Telefone");
		$Tipo 							= $this->input->post("Tipo");

		$this->load->model('PacienteMod');
		$this->PacienteMod->PacienteId	= $PacienteId;
		$this->PacienteMod->Bairro		= $Bairro;
		$this->PacienteMod->Cidade		= $Cidade;
		$this->PacienteMod->Complemento	= $Complemento;
		$this->PacienteMod->Cpf			= $Cpf;
		$this->PacienteMod->Estado		= $Estado;
		$this->PacienteMod->Logradouro	= $Logradouro;
		$this->PacienteMod->Nome		= $Nome;
		$this->PacienteMod->Numero		= $Numero;
		//$this->PacienteMod->QtdTelefone	= $QtdTelefone;
		$this->PacienteMod->Sexo		= $Sexo;
		$this->PacienteMod->Status		= $Status;
		$this->PacienteMod->Telefone	= $Telefone;
		$this->PacienteMod->Tipo		= $Tipo;

		$Pacientes 						= $this->PacienteMod->SalvarEdicao();
	}

	public function EfetuarBaixa(){
		$PacienteId 					= $this->input->post("PacienteId");

		$this->load->model('PacienteMod');
		$this->PacienteMod->PacienteId	= $PacienteId;
		$this->PacienteMod->EfetuaBaixa();
	}
}