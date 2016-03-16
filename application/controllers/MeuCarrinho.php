<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MeuCarrinho extends CI_Controller 
{

	/*
		MÉTODO UTILIZADO PARA MOSTRAR INFORMAÇÃO DOS PRODUTOS NO CARRINHO, FORMA DE ENTREGA E BOTÃO PARA FINALIZAR COM PAGSEGURO
	*/

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

	/*
		MÉTODO USADO PARA LISTAR OS PRODUTOS DO CARRINHO, NA MINHA CESTA MENU
	*/

	public function minhaCesta()
	{
		$produtos = $this->cart->contents();

		$dados = array("produtos" => $produtos);

		$this->load->view("estruturas/minhacesta", $dados);
	}

	/*
		MÉTODO USADO PARA CRIAR OBJETO E INCOVAR MÉTODOS DO PAGSEGURO
	*/

	public function checkout ()
	{
		// Inclui classe de pagamento do pagseguro
		require "includes/php/PagSeguroLibrary/PagSeguroLibrary.php";
		// Instancia novo objeto Pagseguro
		$paymentRequest = new PagSeguroPaymentRequest();
		// Adiciona todos os itens da cesta
		$i = 1;
		foreach ($this->cart->contents() as $item)
			$paymentRequest->addItem($i, $item['name'], $item['qty'], $item['price']);
		// Informa dados da entrega
		$correiosCode = PagSeguroShippingType::getCodeByType("SEDEX");
		$paymentRequest->setShippingType($correiosCode);
		$paymentRequest->setShippingAddress(
			'81030001',
			'Rua Omilio Monteiro Soares',
			'2470',
			'Sb. 07',
			'Fanny',
			'Curitiba',
			'PR',
			'BRA'
		);
		// Informa dados do comprador
		$paymentRequest->setSender(
			'Leonardo Robaskievicz',
			'leonardo@tecworks.com.br',
			'41',
			'99261087',
			'CPF',
			'085.001.219-80'
		);
		// Define moeda
		$paymentRequest->setCurrency("BRL");
		// Definindo URL de retorno depois do pagamento
		$paymentRequest->setRedirectUrl("http://ecommerce.com.br");
		// Inicia checkout transparente -- RODA NO SEM SAIR DO SITE
		try {
			$credentials = PagSeguroConfig::getAccountCredentials();
			$checkoutUrl = $paymentRequest->register($credentials);
			$pos = strpos($checkoutUrl,'code=');
			$code = substr($checkoutUrl, ($pos + 5));
		} catch (PagSeguroServiceException $e) {
			die ($e->getMessage());
		}

		// Dados necessário para página view 
		$carrinho = array("totalItens" => $this->cart->total_items(), "totalCarrinho" => $this->cart->total(), "paymentRequest" => $paymentRequest, "code" => $code);

		$this->load->view('pagseguro/index', $carrinho);
	}

	/*
		MÉTODO USADO PARA FINALIZAR COMPRA COM SUCESSO OU INFORMAR POSSÍVEL ERRO
	*/

	public function salvar ($codTransacao = null) 
	{
		$this->load->model("m_pedidos");

		$retorno = array("gravou" => false);
		if ($codTransacao != null) {

			$codCliente = $this->session->userdata("codigo");
			$param = array("CLIENTE" => $codCliente, "DATA" => date("d/m/Y"), "STATUS" => 1, "ENTREGA" => "SEDEX", "FRETE" => 10.00, "FORMAPG" => 1, "DTENTREGA" => "1 a 2", "HORA" => date("H:i:s"));
			if ($insere = $this->m_pedidos->inserePedido($param)) {
				$i = 1;
				$produtos = $this->cart->contents();
				$produtosArray = array("produtos" => $produtos, "totalItens" => 0, "totalCarrinho" => 0.00);
				foreach($produtos as $item) {
					$chave = str_pad($insere,6,"0",STR_PAD_LEFT).str_pad($i,4,"0",STR_PAD_LEFT);
					$param = array("CHAVE" => $chave, "PEDIDO" => $insere, "PRODUTO" => $item['id'], "QTD" => $item['qty'], "VALOR" => $item['price']);	
					$this->m_pedidos->insereItens($param);
					$i++;
				}
				$retorno['gravou'] = true;
			}
		}

		// Apaga dados do carrinho
		$this->cart->destroy();

		$dados = array_merge($retorno, $produtosArray);

		// Chama view para mostra pedido finalizado com sucesso
		$this->load->view("estruturas/header", $dados);
		$this->load->view("checkout/fim",$dados);
		$this->load->view("estruturas/footer");
	}

}
