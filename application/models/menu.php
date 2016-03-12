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
				$busca = $this->db->simple_query("SELECT * FROM admmenu1 ORDER BY ordem");
				break;
			case "menu2":
				if (($idMenuPai == null) && ($descMenuPai == null))
					$busca = $this->db->simple_query("SELECT * FROM admmenu2 ORDER BY descricao");
				elseif ($descMenuPai == null )
					$busca = $this->db->simple_query("SELECT * FROM admmenu2 WHERE idMenu1 = ".$idMenuPai." ORDER BY descricao");
				else
					$busca = $this->db->simple_query("SELECT b.* FROM admmenu1 a, admmenu2 b WHERE a.descricao LIKE '".$descMenuPai."' AND b.idMenu1 = a.id ORDER BY descricao");
				break;
			case "menu3":
				if (($idMenuPai == null) && ($descMenuPai == null))
					$busca = $this->db->simple_query("SELECT * FROM admmenu3 ORDER BY descricao");
				elseif ($descMenuPai == null )
					$busca = $this->db->simple_query("SELECT * FROM admmenu3 WHERE idMenu2 = ".$idMenuPai." ORDER BY descricao");
				else
					$busca = $this->db->simple_query("SELECT b.* FROM admmenu2 a, admmenu3 b WHERE a.descricao LIKE '".$descMenuPai."' AND b.idMenu2 = a.id ORDER BY descricao");
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

		$busca = $this->db->simple_query("SELECT * FROM ".$tabela." WHERE descricao LIKE '".$desc."' LIMIT 0,1");

		return $busca;
	}

}