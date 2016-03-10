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
	public function buscar ($menu, $idMenu1 = null)
	{
		$this->load->database();// Cria conexao de banco de dados

		switch(strtolower($menu)) {
			case "menu1":
				$busca = $this->db->simple_query("SELECT * FROM admmenu1 ORDER BY ordem");
				break;
			case "menu2":
				if ($idMenu1 == null)
					$busca = $this->db->simple_query("SELECT * FROM admmenu2 ORDER BY descricao");
				else
					$busca = $this->db->simple_query("SELECT * FROM admmenu2 WHERE idMenu1 = ".$idMenu1." ORDER BY descricao");
				break;
		}
		return $busca;
	}

}