<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller {

	public function index()
	{
		$this->novo();
	}

	/*
		Metodo usado para incluir novo cadastro de cliente
	*/

	public function novo()
	{
		$this->load->view('estruturas/header');
		$this->load->view('cadastro/novo');
		$this->load->view('estruturas/footer');
	}
}
