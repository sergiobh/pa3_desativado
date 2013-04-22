<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		// Consulta de um unico registro
		$this->load->model('PacienteMod');
		$this->PacienteMod->PacienteId 	= 1;  // Seleção do paciente
		$Paciente 						= $this->PacienteMod->getPaciente();

		if($Paciente){
			$Dados['Paciente']			= $Paciente;
		}

		// Consulta de vários registros (Grid)



		// Setando um novo registro
		$this->PacienteMod->Nome 		= 'Abcd';
		$this->PacienteMod->Cpf 		= '1234567890';
		$this->PacienteMod->Logradouro 	= 'Rua C';
		$this->PacienteMod->Numero 		= 35;
		$this->PacienteMod->Bairro 		= 'Sei nao';
		$this->PacienteMod->Cidade 		= 'BH';
		$this->PacienteMod->Estado		= strtoupper('mg');
		$this->PacienteMod->Tipo 		= 1; //1-Apto  2-Enfermaria
		$Dados['Gravacao']				= $this->PacienteMod->setPaciente();




		$Dados['View'] 					= 'home/home';
		$this->load->view('body/index', $Dados);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */