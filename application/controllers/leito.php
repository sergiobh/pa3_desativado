<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leito extends CI_Controller {

	public function cadastrar()
	{

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
	
	public function processar(){
		$Dados['View'] 					= 'leito/processar';
		$this->load->view('body/index', $Dados);
	}
}