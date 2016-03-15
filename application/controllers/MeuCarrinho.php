<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MeuCarrinho extends CI_Controller {

	public function index()
	{
		// Busca formas de entregas dos correios
		$result= file_get_contents(site_url('/Correios/calcFrete/81030001'));
		$entrega = json_decode($result);
        // Retorna total de itens do carrinho para a pagina
		$carrinho = array(
			"totalItens" => $this->cart->total_items(), 
			"totalCarrinho" => $this->cart->total(), 
			"produtos" => $produtos = $this->cart->contents(),
			"entrega" => $entrega
		);

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
