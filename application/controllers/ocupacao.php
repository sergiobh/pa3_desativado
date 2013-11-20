<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ocupacao extends CI_Controller {

	public function cadastrar()
	{
		$this->CheckLogado();

		$this->load->model('PacienteMod');
		$Pacientes 							= $this->PacienteMod->FilaEspera();

		$Dados['Pacientes'] 				= $Pacientes;
		$Dados['View'] 						= 'ocupacao/cadastrar';
		$this->load->view('body/index', $Dados);
	}

	public function desocupar(){
		$this->CheckLogado();

		$OcupacaoId							= $this->input->post("OcupacaoId");

		$this->load->model('OcupacaoMod');
		$this->OcupacaoMod->OcupacaoId 		= $OcupacaoId;
		$this->OcupacaoMod->BaixaOcupacao();
	}

	public function salvarCadastro(){
		$PacienteId							= $this->input->post("PacienteId");
		$LeitoId							= $this->input->post("LeitoId");

		$this->load->model('OcupacaoMod');
		$this->OcupacaoMod->PacienteId 		= $PacienteId;
		$this->OcupacaoMod->LeitoId 		= $LeitoId;		
		$this->OcupacaoMod->salvarCadastro();
	}
}