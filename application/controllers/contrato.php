<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contrato extends CI_Controller {

	public function index()
	{
		$this->load->view('contrato/index');
	}
}