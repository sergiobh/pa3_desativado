<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leito extends CI_Controller {

	public function cadastrar()
	{
		$this->load->model('QuartoMod');
		$Andar 							= $this->QuartoMod->getAndar();
		$Dados['Andar'] 				= $Andar;

		$Dados['View'] 					= 'leito/cadastrar';
		$this->load->view('body/index', $Dados);
	}

	public function listar(){

		$this->load->model('LeitoMod');
		$Leitos 					= $this->LeitoMod->Listar();
		$Dados['Leitos'] 			= $Leitos;

		$Dados['View'] 					= 'leito/listar';
		$this->load->view('body/index', $Dados);
	}
	
	public function salvarCadastro(){

		$QuartoId	   = $this->input->post("QuartoId");

		$Identificacao = $this->input->post("Identificacao");


		$this->load->model("LeitoMod");
		$this->LeitoMod->QuartoId		= $QuartoId;
		$this->LeitoMod->Identificacao	= $Identificacao;
		$this->LeitoMod->setLeito();
	}

	public function processar(){
		$Dados['View'] 					= 'leito/processar';
		$this->load->view('body/index', $Dados);
	}

	public function editar(){

		$LeitoId = $this->uri->segment(3);

		$this->load->model("LeitoMod");
		$this->LeitoMod->LeitoId		= $LeitoId;
		$Leito  						= $this->LeitoMod->getLeito();

		$Status 						= $this->LeitoMod->getStatusAll();

		$Dados['Leito']					= $Leito;
		$Dados['Status']				= $Status;

		$Dados['View'] 					= 'leito/editar';
		$this->load->view('body/index', $Dados);
	}

	public function salvarEdicao(){

		$LeitoId 		= $this->input->post("LeitoId");
		$QuartoId	   	= $this->input->post("QuartoId");
		$Identificacao 	= $this->input->post("Identificacao");
		$Status 		= $this->input->post("Status");

		$this->load->model("LeitoMod");
		$this->LeitoMod->LeitoId		= $LeitoId;
		$this->LeitoMod->QuartoId		= $QuartoId;
		$this->LeitoMod->Identificacao	= $Identificacao;
		$this->LeitoMod->Status			= $Status;
		$this->LeitoMod->setEdicao();
	}
}