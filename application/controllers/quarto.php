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
}