<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Funcionario extends CI_Controller {

	public function cadastrar()
	{

		$Dados['View'] 						= 'funcionario/cadastrar';
		$this->load->view('body/index', $Dados);
	}

	public function listar(){

		$this->load->model('FuncionarioMod');
		$Funcionarios 						= $this->FuncionarioMod->Listar();
		$Dados['Funcionarios'] 				= $Funcionarios;

		$Dados['View'] 						= 'funcionario/listar';
		$this->load->view('body/index', $Dados);
	}
	
	public function processar(){
		$Dados['View'] 					= 'funcionario/processar';
		$this->load->view('body/index', $Dados);
	}
}