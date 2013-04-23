<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{

		// Rotina para buscar o status dos leitos
		$this->load->model('LeitoMod');
		$Leitos = $this->LeitoMod->statusLeitos();
		$Dados['Leitos'] 				= $Leitos;

		$Dados['View'] 					= 'home/home';
		$this->load->view('body/index', $Dados);
	}
}