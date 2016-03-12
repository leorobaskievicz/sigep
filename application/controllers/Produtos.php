<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller 
{
	/*
		PÁGINA INICIAL DE PRODUTOS - SEM FILTRO DE MENU OU PESQUISA
	*/

	public function index($limitInf = 0)
	{
		// BUSCA DADOS DOS PRODUTOS NO BANCO DE DADOS
		$this->load->model("m_produtos");

		$dados = array("produtos" => null, "limitInf" => $limitInf);
		if ($produtos = $this->m_produtos->buscar("SELECT CODIGO,NOME,PVENDA,PREPRO,FOTO FROM admprodu LIMIT ".$limitInf))
			if ($produtos->rowCount() > 0)
				$dados = array("produtos" => $produtos, "limitInf" => $limitInf);

		// BUSCA DADOS DO MENU NO BANCO DE DADOS
		$this->load->model('menu');// CARREGA MODELO DE BUSCA MENU
		$menu = array("menu1" => null,"menu2" => null,"menu3" => null);
		if ($busca = $this->menu->buscar('menu1'))
			if ($busca->rowCount() > 0)
				$menu["menu1"] = $busca;

		// AGRUPA OS DOIS VETORES DE BUSCAS PARA RETORNAR SOMENTE UM Á VIEW
		$retorno = array_merge($dados, $menu);

		$this->load->view('estruturas/header');
		$this->load->view('estruturas/menuLeft');
		$this->load->view('produtos/index', $retorno);
		$this->load->view('estruturas/footer');
	}

	/*
		PÁGINA DE PRODUTOS - PARA MENU 1 , MENU2, MENU3
	*/

	public function departamentos ($menu1 = null, $menu2 = null, $menu3 = null, $limitInf = 0)
	{
		// Carrega modelo de busca de produtos no banco de dados
		$this->load->model("m_produtos");

		// BUSCA DADOS DOS PRODUTOS NO BANCO DE DADOS DE ACORDO COM FILTROS
		$dados = array("produtos" => null, "limitInf" => $limitInf);
		if ( $menu3 != null ) { // BUSCA DADOS FILTRADOS POR MENU3
			
			$colunas = "a.CODIGO,a.NOME,a.PVENDA,a.PREPRO,a.FOTO";
			$tabelas = "admprodu a, admproducompl b, admmenu1 c, admmenu2 d, admmenu3 e";
			if ($produtos = $this->m_produtos->buscar("SELECT ".$colunas." FROM ".$tabelas." WHERE a.CODIGO = b.CDPRODU AND b.MENU1 = c.id AND c.descricao = '".$menu1."' AND b.MENU2 = d.id AND d.descricao LIKE '".$menu2."' AND b.MENU3 = e.id AND e.descricao LIKE '".$menu3."' LIMIT ".$limitInf))
				if ($produtos->rowCount() > 0)
					$dados = array("produtos" => $produtos, "limitInf" => $limitInf);

		} elseif ($menu2 != null) {// BUSCA DADOS FILTRADOS POR MENU2
			
			$colunas = "a.CODIGO,a.NOME,a.PVENDA,a.PREPRO,a.FOTO";
			$tabelas = "admprodu a, admproducompl b, admmenu1 c, admmenu2 d";
			if ($produtos = $this->m_produtos->buscar("SELECT ".$colunas." FROM ".$tabelas." WHERE a.CODIGO = b.CDPRODU AND b.MENU1 = c.id AND c.descricao = '".$menu1."' AND b.MENU2 = d.id AND d.descricao LIKE '".$menu2."' LIMIT ".$limitInf))
				if ($produtos->rowCount() > 0)
					$dados = array("produtos" => $produtos, "limitInf" => $limitInf);
		
		}else { // BUSCA DADOS FILTRADOS POR MENU1
			
			$colunas = "a.CODIGO,a.NOME,a.PVENDA,a.PREPRO,a.FOTO";
			$tabelas = "admprodu a, admproducompl b, admmenu1 c";
			if ($produtos = $this->m_produtos->buscar("SELECT ".$colunas." FROM ".$tabelas." WHERE a.CODIGO = b.CDPRODU AND b.MENU1 = c.id AND c.descricao = '".$menu1."' LIMIT ".$limitInf))
				if ($produtos->rowCount() > 0)
					$dados = array("produtos" => $produtos, "limitInf" => $limitInf);
		}

		// BUSCA MENUS NO BANCO DE DADOS DE ACORDO COM LOCALIZAÇÃO DO CLIENTE NO SITE
		if ( $menu2 !=  null ) {
			$this->load->model('menu');// CARREGA MODELO DE BUSCA MENU
			$menu = array("menu1" => null, "menu2" => null, "menu3" => null);
			
			if ($buscaMenu1 = $this->menu->buscarPorDesc("admmenu1",$menu1))
				if ($buscaMenu1->rowCount() == 1)
					$menu["menu1"] = $buscaMenu1;

			if ($buscaMenu2 = $this->menu->buscarPorDesc("admmenu2",$menu2))
				if ($buscaMenu2->rowCount() == 1)
					$menu["menu2"] = $buscaMenu2;

			if ($buscaMenu3 = $this->menu->buscar('menu3', null, $menu2))
				if ($buscaMenu3->rowCount() > 0)
					$menu["menu3"] = $buscaMenu3;

		} else {// BUSCA MENUS DE NÍVEL DOIS NO BANCO DE DADOS - POIS CLIENTE JÁ ENTROU EM MENU NÍVEL 1
			$this->load->model('menu');// CARREGA MODELO DE BUSCA MENU
			$menu = array("menu1" => null, "menu2" => null, "menu3" => null);
			
			if ($buscaMenu1 = $this->menu->buscarPorDesc("admmenu1",$menu1))
				if ($buscaMenu1->rowCount() == 1)
					$menu["menu1"] = $buscaMenu1;

			if ($buscaMenu2 = $this->menu->buscar('menu2', null, $menu1))
				if ($buscaMenu2->rowCount() > 0)
					$menu["menu2"] = $buscaMenu2;
		}

		$retorno = array_merge($menu, $dados);

		$this->load->view('estruturas/header');
		$this->load->view('produtos/index', $retorno);
		$this->load->view('estruturas/footer');
	}

	/*
		PÁGINA DE PRODUTOS - PARA MOSTRAR INFORMAÇÕES DO PRODUTOS DETALHADO
	*/

	public function detalhes ($nome = null, $codigo = null)
	{
		if ($nome == null)
			$dados = array("produto" => null);
		else {
			// BUSCA DADOS DO PRODUTO NO BANCO DE DADOS PELO CÓDIGO OU PELO NOME
			$this->load->model('m_produtos');

			// BUSCA DADOS DO PRODUTO DA TABELA ADMPRODU
			$dados = array("produto" => null);
			if ($codigo != null)
				$buscaProdu = $this->m_produtos->buscarDetalhes("SELECT * FROM admprodu WHERE CODIGO = '".$codigo."' LIMIT 0,1");
			else
				$buscaProdu = $this->m_produtos->buscarDetalhes("SELECT * FROM admprodu WHERE NOME LIKE '".$nome."' LIMIT 0,1");

			if (($buscaProdu) && ($buscaProdu->rowCount() == 1))
				$dados["produto"] = $buscaProdu->fetch();

			// BUSCA DADOS DO COMPLEMENTO PRODUTO DA TABELA ADMPRODUCOMPL
			$complemento = array("produtoCompl" => null);
			if ($codigo != null)
				$buscaProduCompl = $this->m_produtos->buscarDetalhes("SELECT * FROM admproducompl WHERE CDPRODU = '".$codigo."' LIMIT 0,1");

			if (($buscaProduCompl) && ($buscaProduCompl->rowCount() == 1))
				$complemento["produtoCompl"] = $buscaProduCompl->fetch();

			// BUSCA MENU QUE O PRODUTO ESTÁ COMPREENDIDO
			$this->load->model('menu');// CARREGA MODELO DE BUSCA MENU
			$menu = array("menu1" => null, "menu2" => null, "menu3" => null);

			if ($buscaMenu1 = $this->menu->buscar('menu1', null, $complemento['produtoCompl']->menu1))
				if ($buscaMenu1->rowCount() > 0)
					$menu["menu1"] = $buscaMenu1;
		}

		$retorno = array_merge($dados, $complemento, $menu);

		$this->load->view('estruturas/header');
		$this->load->view('produtos/detalhes', $retorno);
		$this->load->view('estruturas/footer');
	}

}