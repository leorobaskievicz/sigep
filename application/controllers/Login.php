<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index($pageBack = "/Home")
	{
		if ($this->input->get("volta") != null)
			$pageBack = base64_decode($this->input->get("volta"));

		$this->fazerLogin ($pageBack);
	}

	/*
		Metodo usado para fazer login do usuário no site
	*/

	public function fazerLogin ($pageBack = null)
	{
		if ($this->input->get("volta") != null)
			$pageBack = base64_decode($this->input->get("volta"));
		else if ($pageBack == null)
			$pageBack = "/Home";

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
				$this->session->set_flashdata('login', true);
				redirect($pageBack);
			} else {
				$this->session->set_flashdata('login', "erro");
				redirect($pageBack);
			}

		} else {
			// Retorna total de itens do carrinho para a pagina
			$carrinho = array("totalItens" => $this->cart->total_items(), "totalCarrinho" => $this->cart->total(), "pageBack" => $pageBack);

			$this->load->view('estruturas/header', $carrinho);
			$this->load->view('login/index',$carrinho);
			$this->load->view('estruturas/footer');
		}
	}

	/*
		Método para fazer logout do usuário - Deletando variável de sessão do site
	*/

	public function fazerLogout ($pageBack = "/Home")
	{
		if ($this->input->get("volta") != null)
			$pageBack = base64_decode($this->input->get("volta"));

		$this->session->unset_userdata('codigo');
		$this->session->unset_userdata('nome');
		redirect($pageBack);
	}
}
