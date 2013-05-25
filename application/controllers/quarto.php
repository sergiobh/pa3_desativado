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