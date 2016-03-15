<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MeuCarrinho extends CI_Controller {

	public function index()
	{
		
        // Retorna total de itens do carrinho para a pagina
		$carrinho = array("totalItens" => $this->cart->total_items(), "totalCarrinho" => $this->cart->total(), "produtos" => $produtos = $this->cart->contents());

		$this->load->view('estruturas/header', $carrinho);
		$this->load->view('checkout/index', $carrinho);
		$this->load->view('estruturas/footer');
	}

	public function minhaCesta()
	{
		$produtos = $this->cart->contents();

		$dados = array("produtos" => $produtos);

		$this->load->view("estruturas/minhacesta", $dados);
	}
}
