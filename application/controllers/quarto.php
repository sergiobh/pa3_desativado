<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quarto extends CI_Controller {

	public function cadastrar()
	{
		$this->CheckLogado();

		$Dados['View'] 					= 'quarto/cadastrar';
		$this->load->view('body/index', $Dados);
	}

	public function listar(){
		$this->CheckLogado();

		$this->load->model('QuartoMod');
		$Quartos 						= $this->QuartoMod->Listar();
		$Dados['Quartos'] 				= $Quartos;

		$Dados['View'] 					= 'quarto/listar';
		$this->load->view('body/index', $Dados);
	}

	public function getAndar(){
		$PacienteId 					= $this->input->get("PacienteId");
		$Ocupacao 						= $this->input->get("Ocupacao");

		$this->load->model('QuartoMod');
		$this->QuartoMod->Ocupacao 		= $Ocupacao;
		$this->QuartoMod->PacienteId	= $PacienteId;
		$Andar 							= $this->QuartoMod->getAndar();
		$Dados["Andares"] 				= $Andar;

		$Dados["success"] 				= true;

		//$this->load->view('quarto/selectAndar', $Dados);
		echo json_encode($Dados);
	}

	public function getQuartos(){
		$Andar 			= $this->input->get("Andar");
		$Ocupacao 		= $this->input->get("Ocupacao");
		$PacienteId 	= $this->input->get("PacienteId");

		$this->load->model('QuartoMod');
		$this->QuartoMod->Andar 		= $Andar;
		$this->QuartoMod->Ocupacao 		= $Ocupacao;
		$this->QuartoMod->PacienteId	= $PacienteId;
		$Quartos 						= $this->QuartoMod->getQuartos();
		$Dados['Quartos'] 				= $Quartos;

		$Dados['success'] 				= true;

		//$this->load->view('quarto/selectQuarto', $Dados);
		echo json_encode($Dados);
	}
	
	public function processar(){
		$this->CheckLogado();

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
		$this->CheckLogado();

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
		$Andar 			= $this->input->post("Andar");
		$Status 		= $this->input->post("Status");

		$this->load->model("QuartoMod");
		$this->QuartoMod->QuartoId		= $QuartoId;
		$this->QuartoMod->Identificacao	= $Identificacao;
		$this->QuartoMod->Andar			= $Andar;
		$this->QuartoMod->Status		= $Status;
		$this->QuartoMod->setEdicao();
	}
}