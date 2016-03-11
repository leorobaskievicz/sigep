<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller 
{

	public function index($limitInf = 0)
	{
		// Carrega modelo de busca de produtos no banco de dados
		$this->load->model("m_produtos");

		$this->load->view('estruturas/header');

		$dados = array("produtos" => null, "limitInf" => $limitInf);
		if ($produtos = $this->m_produtos->buscar("SELECT CODIGO,NOME,PVENDA,PREPRO,FOTO FROM admprodu LIMIT ".$limitInf))
			if ($produtos->rowCount() > 0)
				$dados = array("produtos" => $produtos, "limitInf" => $limitInf);

		$this->load->view('estruturas/menuLeft');
		$this->load->view('produtos/index', $dados);
		$this->load->view('estruturas/footer');
	}

}
