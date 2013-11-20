<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Funcionario extends CI_Controller {

	public function cadastrar()
	{
		$this->CheckLogado();

		$Dados['View'] 						= 'funcionario/cadastrar';
		$this->load->view('body/index', $Dados);
	}

	public function listar(){
		$this->CheckLogado();

		$Dados['View'] 						= 'funcionario/listar';
		$this->load->view('body/index', $Dados);
	}
	
	public function processar(){
		$this->CheckLogado();

		$Dados['View'] 					= 'funcionario/processar';
		$this->load->view('body/index', $Dados);
	}

	public function salvarCadastro(){

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

    public function montaGrid(){
		$this->load->model('FuncionarioMod');
		$Funcionarios 						= $this->FuncionarioMod->Listar();
		$Dados['Funcionarios'] 				= $Funcionarios;

		$Dados['success'] = ($Dados['Funcionarios']) ? true : false;

		echo json_encode($Dados);
    }

   	public function Logar(){
		if(!isset($_POST['Cpf']) || !isset($_POST['Senha'])){
			echo '{success: false}';
			exit;
		}

		$Cpf	= $_POST['Cpf'];
		$Senha	= $_POST['Senha'];

		$this->load->model('FuncionarioMod');
		$this->FuncionarioMod->Cpf 	= $Cpf;
		$Usuario					= $this->FuncionarioMod->getFuncionario();

		if(is_object($Usuario)){
			$this->load->library('CriptografiaLib');
			// Validação da senha
			if($Usuario->Senha === $this->criptografialib->Gerar($Senha)){
				// Insere os dados do usuário na sessão
				$_SESSION['Funcionario']	= $Usuario;

				echo '{"success": true}';
			}
			else{
				echo '{"success": false}';
			}
		}
		else{
			echo '{"success": false}';
		}
	}

	public function deslogar(){
		unset($_SESSION['Funcionario']);

		header('Location: '.BASE_URL.'/funcionario/login');
	}

	public function login(){
		$Dados['View'] 					= 'funcionario/login';
		$this->load->view('body/index', $Dados);
	}
}