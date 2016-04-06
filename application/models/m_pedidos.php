<?php
/*
	CLASSE CRIADO PARA ADMINISTRAR OS PEDIDOS NO BANCO DE DADOS
	@authorLEONARDO ROBASKIEVICZ - 05/12/2015
	LEONARDO@TECWORKS.COM.BR

*/
class M_Pedidos extends CI_Model
{
	private $table = "admped1";
	private $table2 = "admped2";
	private $limit = 20;

	public function __construct() 
	{
		parent::__construct();
	}

	/**
	* FUNÇÃO PARA BUSCAR DADOS DOS PEDIDOS NO BD
	* @param int número da página
	* @return bool(false) se falhar, pdo object com dados
	*/

	public function read ($page = 0, $search = null, $tipoFiltro = null)
	{
		$this->load->database();// Cria conexao de banco de dados
		if ($search == null)
			$busca = $this->db->simple_query("SELECT a.*,sum(b.QTD * b.VALOR) as vlrtotal,c.nome FROM ".$this->table." a, ".$this->table2." b, admcad1 c WHERE a.PEDIDO = b.PEDIDO and a.CLIENTE = c.CODIGO GROUP BY a.PEDIDO ORDER BY PEDIDO DESC LIMIT ".$page.",".$this->limit);
		else {
			switch (strtolower($tipoFiltro)) {
				case "numero":
					$busca = $this->db->simple_query("SELECT a.*,sum(b.QTD * b.VALOR) as vlrtotal,c.nome FROM ".$this->table." a, ".$this->table2." b, admcad1 c WHERE a.PEDIDO = b.PEDIDO and a.CLIENTE = c.CODIGO and a.PEDIDO = '".$search."' GROUP BY a.PEDIDO ORDER BY PEDIDO DESC");
					break;
				case "data":
					$busca = $this->db->simple_query("SELECT a.*,sum(b.QTD * b.VALOR) as vlrtotal,c.nome FROM ".$this->table." a, ".$this->table2." b, admcad1 c WHERE a.PEDIDO = b.PEDIDO and a.CLIENTE = c.CODIGO and a.DATA LIKE '".$search."' GROUP BY a.PEDIDO ORDER BY PEDIDO DESC");
					break;
				case "status":
					$busca = $this->db->simple_query("SELECT a.*,sum(b.QTD * b.VALOR) as vlrtotal,c.nome FROM ".$this->table." a, ".$this->table2." b, admcad1 c WHERE a.PEDIDO = b.PEDIDO and a.CLIENTE = c.CODIGO and a.STATUS = '".$search."' GROUP BY a.PEDIDO ORDER BY PEDIDO DESC");
					break;
				default: 
					$busca = $this->db->simple_query("SELECT a.*,sum(b.QTD * b.VALOR) as vlrtotal,c.nome FROM ".$this->table." a, ".$this->table2." b, admcad1 c WHERE a.PEDIDO = b.PEDIDO and a.CLIENTE = c.CODIGO and (a.PEDIDO = '".$search."' or c.NOME LIKE '%".$search."%' or a.DATA LIKE '".$search."' or a.STATUS = '".$search."' or a.ENTREGA LIKE '".$search."' or FORMAPG LIKE '".$search."') GROUP BY a.PEDIDO ORDER BY PEDIDO DESC");
					break;
			}
		}
		if (($busca) && ($busca->rowCount() > 0)) 
			return $busca->fetchAll();
		else
			return false;
	}

	/**
	* FUNÇÃO PARA BUSCAR DADOS DE UM PEDIDO
	* @param int código do pedido
	* @return bool(false) se falhar, pdo object com dados
	*/

	public function getByCod ($codigo = 0) 
	{
		$db = $this->load->database("televendas", true);// Cria conexao de banco de dados
		$busca = $db->simple_query("SELECT a.*,c.* FROM ".$this->table." a, admcad1 c WHERE a.pedido = '".$codigo."' and a.cliente = c.codigo");
		if (($busca) && ($busca->rowCount() > 0)) 
			return $busca->fetch();
		else
			return false;
	}

}