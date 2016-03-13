<?php
/*
	CLASSE CRIADO PARA ADMINISTRAR TODO O CADASTRO DE CLIENTES DO SITE
	FORMATO CRUD PARA TABELA ADMCAD1

	@authorLEONARDO ROBASKIEVICZ - 05/12/2015
	LEONARDO@TECWORKS.COM.BR

*/
class Menu extends CI_Model
{

	public function __construct() 
	{
		parent::__construct();
	}

	/*
		FUNÇÃO PARA BUSCAR OS DADOS DOS MENUS NO BANCO DADOS
		@param string nome da tabela
		@return query - retorno da busca
	*/
	public function buscar ($menu, $idMenuPai = null, $descMenuPai = null)
	{
		$this->load->database();// Cria conexao de banco de dados

		switch(strtolower($menu)) {
			case "menu1":
				$busca = $this->db->simple_query("SELECT * FROM webmenu1 ORDER BY ordem");
				break;
			case "menu2":
				if (($idMenuPai == null) && ($descMenuPai == null))
					$busca = $this->db->simple_query("SELECT * FROM webmenu2 ORDER BY descricao");
				elseif ($descMenuPai == null )
					$busca = $this->db->simple_query("SELECT * FROM webmenu2 WHERE MENU1 = ".$idMenuPai." ORDER BY descricao");
				else
					$busca = $this->db->simple_query("SELECT b.* FROM webmenu1 a, webmenu2 b WHERE a.descricao LIKE '".str_replace("%20"," ", $descMenuPai)."' AND b.MENU1 = a.CDMENU ORDER BY descricao");
				break;
			case "menu3":
				if (($idMenuPai == null) && ($descMenuPai == null))
					$busca = $this->db->simple_query("SELECT * FROM webmenu3 ORDER BY descricao");
				elseif ($descMenuPai == null )
					$busca = $this->db->simple_query("SELECT * FROM webmenu3 WHERE MENU2 = ".$idMenuPai." ORDER BY descricao");
				else
					$busca = $this->db->simple_query("SELECT b.* FROM webmenu2 a, webmenu3 b WHERE a.descricao LIKE '".str_replace("%20", "", $descMenuPai)."' AND b.MENU2 = a.CDMENU ORDER BY descricao");
				break;
		}

		return $busca;
	}

	/*
		FUNÇÃO PARA BUSCAR OS DADOS DOS MENUS NO BANCO DADOS DE ACORDO COM A DESCRIÇÃO
		@param string descrição do menu
		@return query - retorno da busca
	*/
	public function buscarPorDesc ($tabela = null, $desc = null)
	{
		$this->load->database();// Cria conexao de banco de dados

		$busca = $this->db->simple_query("SELECT * FROM ".$tabela." WHERE descricao LIKE '".str_replace("%20"," ",$desc)."' LIMIT 0,1");

		return $busca;
	}

}