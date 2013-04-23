<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acomodacao extends CI_Controller {

	public function cadastrar()
	{

		$Dados['View'] 						= 'acomodacao/cadastrar';
		$this->load->view('body/index', $Dados);
	}

	public function desocupar(){

		$this->load->model('AcomodacaoMod');
		$Acomodacoes 						= $this->AcomodacaoMod->Listar();
		$Dados['Acomodacoes'] 				= $Acomodacoes;

		$Dados['View'] 						= 'acomodacao/desocupar';
		$this->load->view('body/index', $Dados);
	}
}