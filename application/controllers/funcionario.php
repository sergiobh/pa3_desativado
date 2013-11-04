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

	public function salvarCadastro(){
//$RETORNO['A'] = $_SERVER['REQUEST_METHOD'];
//$RETORNO['B'] = $id;
		

		$Nome			= $this->input->post('Nome');
		$Cpf   			= $this->input->post('Cpf');
		$GrupoId 		= $this->input->post('GrupoId');
		$Senha			= $this->input->post('Senha');

		$this->load->model('FuncionarioMod');
		$this->FuncionarioMod->Nome 		= $Nome;
		$this->FuncionarioMod->Cpf 			= $Cpf;
		$this->FuncionarioMod->GrupoId  	= $GrupoId;
		$this->FuncionarioMod->Senha 		= $Senha;
		$Gravado							= $this->FuncionarioMod->SalvarCadastro();

		$Retorno['success'] = true;
		$Retorno['status']  = $Gravado->Status;
		$Retorno['msg']	    = $Gravado->Msg;

		echo json_encode($Retorno);
	}
}