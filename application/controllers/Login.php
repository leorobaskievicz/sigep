<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->fazerLogin();
	}

	/*
		Metodo usado para fazer login do usuário no site
	*/

	public function fazerLogin()
	{
		if (($this->input->post('email-login') != null) && ($this->input->post('senha-login') != null)) {
			// RECEBE AS VARIÁVEIS PASSADAS PELO FORMULÁRIO
			$email = $this->input->post('email-login');
			$senha = $this->input->post('senha-login');

			$this->load->model('clientes');
			$busca = $this->clientes->getLogin($email, $senha);
			if ($busca[0]) {
				$dados = array(
					"codigo" => $busca[1],
					"nome" => $busca[2]);
				$this->session->set_userdata($dados);	
				$dados = array("login" => true);
				$this->load->view('estruturas/header');
				$this->load->view('home', $dados);
				$this->load->view('estruturas/footer');
			} else {
				$dados = array("login" => false);
				$this->load->view('estruturas/header');
				$this->load->view('login/index', $dados);
				$this->load->view('estruturas/footer');
			}
		} else {
			$this->load->view('estruturas/header');
			$this->load->view('login/index');
			$this->load->view('estruturas/footer');
		}
	}

	/*
		Método para fazer logout do usuário - Deletando variável de sessão do site
	*/

	public function fazerLogout ()
	{
		$this->session->unset_userdata('codigo');
		$this->session->unset_userdata('nome');
		$this->load->view('estruturas/header');
		$this->load->view('home');
		$this->load->view('estruturas/footer');
	}
}
