<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller 
{
	/*
		PÁGINA INICIAL DE PRODUTOS - SEM FILTRO DE MENU OU PESQUISA
	*/

	public function index()
	{
		// TRATA DOS LIMITES DA PAGINAS
		if ($this->input->get("per_page"))
			$limitInf = $this->input->get("per_page");
		else
			$limitInf = 0;

		// BUSCA DADOS DOS PRODUTOS NO BANCO DE DADOS
		$this->load->model("m_produtos");

		$dados = array("produtos" => null);
		if ($produtos = $this->m_produtos->buscar("SELECT CODIGO,NOME,PRECO,PREPRO,ESTOQUE FROM pdvprodu LIMIT ".$limitInf))
			if ($produtos->rowCount() > 0)
				$dados = array("produtos" => $produtos);

		// BUSCA DADOS DO MENU NO BANCO DE DADOS
		$this->load->model('menu');// CARREGA MODELO DE BUSCA MENU
		$menu = array("menu1" => null,"menu2" => null,"menu3" => null);

		if ($busca = $this->menu->buscar('menu1'))
			if ($busca->rowCount() > 0)
				$menu["menu1"] = $busca;

		$totalregs = 0;
		if ($buscaTotalRegs = $this->m_produtos->buscaNumRegs('SELECT count(*) as totalRegs FROM pdvproducompl'))
			if($buscaTotalRegs->rowCount() == 1) {
				$reg = $buscaTotalRegs->fetch();
				$totalregs = $reg->totalregs;
			}

		// Configuracoes para paginacao
		$config["base_url"] = base_url("Produtos/index");
        $config["total_rows"] = $totalregs;
        $this->pagination->initialize($config);

        // Retorna total de itens do carrinho para a pagina
		$carrinho = array("totalItens" => $this->cart->total_items(), "totalCarrinho" => $this->cart->total());

		// AGRUPA OS DOIS VETORES DE BUSCAS PARA RETORNAR SOMENTE UM Á VIEW
		$retorno = array_merge($dados, $menu);

		$this->load->view('estruturas/header', $carrinho);
		$this->load->view('produtos/index', $retorno);
		$this->load->view('estruturas/footer');
	}

	/*
		PÁGINA DE PRODUTOS - PARA MENU 1 , MENU2, MENU3
	*/

	public function departamentos ($menu1 = null, $menu2 = 0, $menu3 = 0)
	{
		if ($menu1 == null) {
			$this->index();
			return 0;
		}

		// TRATA DOS LIMITES DA PAGINAS
		if ($this->input->get("per_page"))
			$limitInf = $this->input->get("per_page");
		else
			$limitInf = 0;

		// Carrega modelo de busca de produtos no banco de dados
		$this->load->model("m_produtos");
		$this->load->model('menu');

		// BUSCA DADOS DOS PRODUTOS NO BANCO DE DADOS DE ACORDO COM FILTROS
		$dados = array("produtos" => null);

		if ( $menu3 != 0 ) { // BUSCA DADOS FILTRADOS POR MENU3
			
			// BUSCA DOS PRODUTOS
			$colunas = "a.CODIGO,a.NOME,a.PRECO,a.PREPRO,a.ESTOQUE";
			$tabelas = "pdvprodu a, pdvproducompl b, webmenu1 c, webmenu2 d, webmenu3 e";
			if ($produtos = $this->m_produtos->buscar("SELECT ".$colunas." FROM ".$tabelas." WHERE a.CODIGO = b.CDPRODU AND b.MENU1 = c.CDMENU AND c.descricao = '".str_replace("%20"," ",$menu1)."' AND b.MENU2 = d.CDMENU AND d.descricao LIKE '".str_replace("%20"," ",$menu2)."' AND b.MENU3 = e.CDMENU AND e.descricao LIKE '".str_replace("%20"," ",$menu3)."' LIMIT ".$limitInf))
				if ($produtos->rowCount() > 0)
					$dados = array("produtos" => $produtos);

			// BUSCA DOS MENUS


		} elseif ( $menu2 != 0 ) {// BUSCA DADOS FILTRADOS POR MENU2
			
			// BUSCA DOS PRODUTOS
			$colunas = "a.CODIGO,a.NOME,a.PRECO,a.PREPRO,a.ESTOQUE";
			$tabelas = "pdvprodu a, pdvproducompl b, webmenu1 c, webmenu2 d";
			if ($produtos = $this->m_produtos->buscar("SELECT ".$colunas." FROM ".$tabelas." WHERE a.CODIGO = b.CDPRODU AND b.MENU1 = c.CDMENU AND c.descricao = '".str_replace("%20"," ",$menu1)."' AND b.MENU2 = d.CDMENU AND d.descricao LIKE '".str_replace("%20"," ",$menu2)."' LIMIT ".$limitInf))
				if ($produtos->rowCount() > 0)
					$dados = array("produtos" => $produtos);

			// BUSCA DOS MENUS
			$menu = array("menu1" => null, "menu2" => null, "menu3" => null);
			
			if ($buscaMenu1 = $this->menu->buscarPorDesc("webmenu1",$menu1))
				if ($buscaMenu1->rowCount() == 1)
					$menu["menu1"] = $buscaMenu1;

			if ($buscaMenu2 = $this->menu->buscarPorDesc("webmenu2",$menu2))
				if ($buscaMenu2->rowCount() == 1)
					$menu["menu2"] = $buscaMenu2;

			if ($buscaMenu3 = $this->menu->buscar('menu3', null, $menu2))
				if ($buscaMenu3->rowCount() > 0)
					$menu["menu3"] = $buscaMenu3;

			$totalregs = 0;
			if ($buscaTotalRegs = $this->m_produtos->buscaNumRegs('SELECT count(*) as totalRegs FROM pdvproducompl a, webmenu1 b, webmenu2 c WHERE a.MENU1 = b.CDMENU AND a.MENU2 = b.CDMENU AND b.DESCRICAO = "'.$menu1.'" AND c.DESCRICAO = "'.$menu2.'"'))
				if($buscaTotalRegs->rowCount() == 1) {
					$reg = $buscaTotalRegs->fetch();
					$totalregs = $reg->totalregs;
				}
		
		}else { // BUSCA DADOS FILTRADOS POR MENU1
			
			// BUSCA DOS PRODUTOS NO BANCO DE DADOS
			$colunas = "a.CODIGO,a.NOME,a.PRECO,a.PREPRO,a.ESTOQUE";
			$tabelas = "pdvprodu a, pdvproducompl b, webmenu1 c";
			if ($produtos = $this->m_produtos->buscar("SELECT ".$colunas." FROM ".$tabelas." WHERE a.CODIGO = b.CDPRODU AND b.MENU1 = c.CDMENU AND c.DESCRICAO = '".str_replace("%20"," ",$menu1)."' LIMIT ".$limitInf))
				if ($produtos->rowCount() > 0)
					$dados = array("produtos" => $produtos);

			// BUSCA DOS MENUS
			$menu = array("menu1" => null, "menu2" => null, "menu3" => null);
			
			if ($buscaMenu1 = $this->menu->buscarPorDesc("webmenu1",$menu1))
				if ($buscaMenu1->rowCount() == 1)
					$menu["menu1"] = $buscaMenu1;

			if ($buscaMenu2 = $this->menu->buscar('menu2', null, $menu1))
				if ($buscaMenu2->rowCount() > 0)
					$menu["menu2"] = $buscaMenu2;

			$totalregs = 0;
			if ($buscaTotalRegs = $this->m_produtos->buscaNumRegs('SELECT count(*) as totalRegs FROM pdvproducompl a, webmenu1 b WHERE a.MENU1 = b.CDMENU AND b.DESCRICAO = "'.$menu1.'"'))
				if($buscaTotalRegs->rowCount() == 1) {
					$reg = $buscaTotalRegs->fetch();
					$totalregs = $reg->totalregs;
				}
		}

		// CONFIGURACOES PARA PAGINACAO
		$config["base_url"] = base_url("Produtos/departamentos/".$menu1."/".$menu2."/".$menu3);
        $config["total_rows"] = $totalregs;
        $this->pagination->initialize($config);

        // Retorna total de itens do carrinho para a pagina
		$carrinho = array("totalItens" => $this->cart->total_items(), "totalCarrinho" => $this->cart->total());

		$retorno = array_merge($menu, $dados);

		$this->load->view('estruturas/header', $carrinho);
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

			// BUSCA DADOS DO PRODUTO DA TABELA pdvprodu
			$dados = array("produto" => null);
			if ($codigo != null)
				$buscaProdu = $this->m_produtos->buscarDetalhes("SELECT * FROM pdvprodu WHERE CODIGO = '".$codigo."' LIMIT 0,1");
			else
				$buscaProdu = $this->m_produtos->buscarDetalhes("SELECT * FROM pdvprodu WHERE NOME LIKE '".$nome."' LIMIT 0,1");

			if (($buscaProdu) && ($buscaProdu->rowCount() == 1))
				$dados["produto"] = $buscaProdu->fetch();

			// BUSCA DADOS DO COMPLEMENTO PRODUTO DA TABELA pdvproduCOMPL
			$complemento = array("produtoCompl" => null);
			if ($codigo != null)
				$buscaProduCompl = $this->m_produtos->buscarDetalhes("SELECT * FROM pdvproducompl WHERE CDPRODU = '".$codigo."' LIMIT 0,1");

			if (($buscaProduCompl) && ($buscaProduCompl->rowCount() == 1))
				$complemento["produtoCompl"] = $buscaProduCompl->fetch();

			// BUSCA MENU QUE O PRODUTO ESTÁ COMPREENDIDO
			$this->load->model('menu');// CARREGA MODELO DE BUSCA MENU
			$menu = array("menu1" => null, "menu2" => null, "menu3" => null);

			if ($buscaMenu1 = $this->menu->buscar('menu1', $complemento['produtoCompl']->menu1, null))
				if ($buscaMenu1->rowCount() > 0)
					$menu["menu1"] = $buscaMenu1;

			// BUSCA PRODUTOS PARECIDOS
			$colunas = "a.CODIGO,a.NOME,a.PRECO,a.PREPRO";
			$tabelas = "pdvprodu a, pdvproducompl b, webmenu1 c";
			$prodParecidos = array("parecidos" => null);
			if ($buscaParecidos = $this->m_produtos->buscar("SELECT ".$colunas." FROM ".$tabelas." WHERE a.CODIGO = b.CDPRODU AND b.MENU1 = '".$complemento['produtoCompl']->menu1."' GROUP BY b.CDPRODU LIMIT 0"))
				if ($buscaParecidos->rowCount() > 0)
					$prodParecidos["parecidos"] = $buscaParecidos;
		}

		// Retorna total de itens do carrinho para a pagina
		$carrinho = array("totalItens" => $this->cart->total_items(), "totalCarrinho" => $this->cart->total());

		$retorno = array_merge($dados, $complemento, $menu, $prodParecidos);

		$this->load->view('estruturas/header', $carrinho);
		$this->load->view('produtos/detalhes', $retorno);
		$this->load->view('estruturas/footer');
	}

	/*
		PÁGINA PARA SALVAR AVISA-ME QUANDO CHEGAR - VINDA DE UMA AQUISICAO AJAX
	*/

	public function avisamequandochegar ()
	{
		$nome   = $this->input->post("nome-avisamequandochegar");
		$email  = $this->input->post("email-avisamequandochegar");
		$tel    = $this->input->post("tel-avisamequandochegar");
		$codigo = $this->input->post("codigo-avisamequandochegar");
		$preco  = $this->input->post("preco-avisamequandochegar");
		$obs    = $this->input->post("obs-avisamequandochegar");

		$this->load->model("m_avisamequandochegar");
		$param = array("nomeCliente" => $nome, "emailCliente" => $email, "telefoneCliente" => $tel, "produto" => $codigo, "preco" => $preco, "obs" => $obs, "data" => date("Y-m-d"));
		if ($insere = $this->m_avisamequandochegar->salvar($param))
			echo ("true");
		else
			echo ("false");
	}

}
