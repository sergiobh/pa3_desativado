<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quarto extends CI_Controller {

	public function cadastrar()
	{
		$Dados['View'] 					= 'quarto/cadastrar';
		$this->load->view('body/index', $Dados);
	}

	public function listar(){

		$this->load->model('QuartoMod');
		$Quartos 						= $this->QuartoMod->Listar();
		$Dados['Quartos'] 				= $Quartos;

		$Dados['View'] 					= 'quarto/listar';
		$this->load->view('body/index', $Dados);
	}

	public function getAndar(){
		$PacienteId 					= $this->input->post("PacienteId");
		$Ocupacao 						= $this->input->post("Ocupacao");

		$this->load->model('QuartoMod');
		$this->QuartoMod->Ocupacao 		= $Ocupacao;
		$this->QuartoMod->PacienteId	= $PacienteId;
		$Andar 							= $this->QuartoMod->getAndar();
		$Dados['Andar'] 				= $Andar;

		$this->load->view('quarto/selectAndar', $Dados);
	}

	public function getQuartos(){
		$Andar 			= $this->input->post("Andar");
		$Ocupacao 		= $this->input->post("Ocupacao");
		$PacienteId 	= $this->input->post("PacienteId");

		$this->load->model('QuartoMod');
		$this->QuartoMod->Andar 		= $Andar;
		$this->QuartoMod->Ocupacao 		= $Ocupacao;
		$this->QuartoMod->PacienteId	= $PacienteId;
		$Quartos 						= $this->QuartoMod->getQuartos();
		$Dados['Quartos'] 				= $Quartos;

		$this->load->view('quarto/selectQuarto', $Dados);
	}
	
	public function processar(){
		$Dados['View'] 					= 'quarto/processar';
		$this->load->view('body/index', $Dados);
	}

	public function salvarCadastro(){
		$Andar 			= $this->input->post("Andar");
		$Identificacao 	= $this->input->post("Identificacao");

		$this->load->model("QuartoMod");
		$this->QuartoMod->Andar			= $Andar;
		$this->QuartoMod->Identificacao	= $Identificacao;
		$this->QuartoMod->setQuarto();
	}

	public function editar(){
		$QuartoId = $this->uri->segment(3);

		$this->load->model("QuartoMod");
		$this->QuartoMod->QuartoId		= $QuartoId;
		$Quarto  						= $this->QuartoMod->getQuarto();

		$Status 						= $this->QuartoMod->getStatusAll();

		$Dados['Quarto']				= $Quarto;
		$Dados['Status']				= $Status;

		$Dados['View'] 					= 'quarto/editar';
		$this->load->view('body/index', $Dados);
	}

	public function salvarEdicao(){

		$QuartoId	   	= $this->input->post("QuartoId");
		$Identificacao 	= $this->input->post("Identificacao");
		$Status 		= $this->input->post("Status");

		$this->load->model("QuartoMod");
		$this->QuartoMod->QuartoId		= $QuartoId;
		$this->QuartoMod->Identificacao	= $Identificacao;
		$this->QuartoMod->Status		= $Status;
		$this->QuartoMod->setEdicao();
	}
}