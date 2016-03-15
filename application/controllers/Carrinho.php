<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrinho extends CI_Controller {

	private $cliente = null;
	private $frete = array("codigo" => null, "servico" => null, "prazo" => null, "valor" => null);
	private $formapg = null;
	private $ip = null;

	public function index()
	{
		echo ("Especifique qual métodos você deseja utilizar.");
	}

	/*
		FUNCAO PARA SALVAR PRODUTO NO CARRINHO DE COMPRAS
		@param int codigo, string nome, float qtd, float preco
		@return string endereco
	*/

	public function salvar ($codigo = null, $nome = null, $qtd = null, $preco = null)
	{
		if (($this->input->get("codigo") != null) && ($this->input->get("nome") != null) && ($this->input->get("qtd") != null) && ($this->input->get("preco") != null)) {
			$codigo = $this->input->get("codigo");
			$nome   = $this->input->get("nome");
			$qtd    = $this->input->get("qtd");
			$preco  = $this->input->get("preco");
		}

		if (($codigo != null) && ($nome != null) && ($qtd != null) && ($preco != null)) {

			$data = array(
               'id'      => $codigo,
               'qty'     => $qtd,
               'price'   => $preco,
               'name'    => $nome,
               //'options' => array('Size' => 'L', 'Color' => 'Red')
            );

			echo ($this->cart->insert($data));

		} else
			echo ("false");
	}

	/*
		FUNCAO PARA VISUALIZAR PRODUTOS CONTIDOS NA CESTA
		@param int codigo, string nome, float qtd, float preco
		@return string endereco
	*/

	public function editar ($rowid = null, $qtd = null)
	{
		if (($this->input->get("rowid") != null) && ($this->input->get("qtd") != null)) {
			$rowid = $this->input->get("rowid");
			$qtd   = $this->input->get("qtd");
		}

		if (($rowid != null) && ($qtd != null)) {

			$data = array(
               'rowid' => $rowid,
               'qty'   => $qtd
            );

			if ($this->cart->update($data) == 1)
				echo ("true");
			else
				echo ("false");
		} else
			echo ("false");
	}

	/*
		FUNCAO PARA APAGAR TODO O CARRINHO
		@param void
		@return void
	*/

	public function apaga ()
	{
		$this->cart->destroy();
	}

	/*
		FUNCAO PARA VISUALIZAR O TOTAL DA CESTA
		@param void 
		@return float total
	*/

	public function total ()
	{
		echo ($this->cart->total());
	}

	/*
		FUNCAO PARA VISUALIZAR O TOTAL DE ITENS DA CESTA
		@param void 
		@return float total
	*/

	public function totalItens ()
	{
		echo ($this->cart->total_items());
	}

	/*
		FUNCAO PARA RETORNOAR ROW ID DO PRODUTOS
		@param void 
		@return float total
	*/

	public function getRowid ($codigo = null, $qtd = null, $preco = null)
	{
		$achou = false;
		$rowid = null;

		if (($codigo != null) && ($qtd != null) && ($preco != null)) {
			$produtos = $this->cart->contents();
			foreach ($produtos as $item) {
				if (($codigo == $item['id']) && ($qtd == $item['qty']) && ($preco == $item['price'])) {
					$achou = true;
					$rowid = $item['rowid'];
				}

			}
		}

		print_r (array($achou, $rowid));
	}

	/*
		FUNCAO PARA RETORNOAR TODOS OS PRODUTOS CONTIDOS NO CARRINHO
		@param void 
		@return float total
	*/

	public function getProdutos ()
	{
		print_r ($this->cart->contents());
	}
	
}
