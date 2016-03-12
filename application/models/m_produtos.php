<?php
/*
	CLASSE CRIADO PARA ADMINISTRAR TODO O CADASTRO DE PRODUTOS DO SITE
	FORMATO CRUD PARA TABELA ADMPRODU

	@authorLEONARDO ROBASKIEVICZ - 05/12/2015
	LEONARDO@TECWORKS.COM.BR

*/
class M_Produtos extends CI_Model
{
	private $limitSup = 20;
	private $table = "admprodu";

	/* 
		FUNÇÃO PARA SETAR TODOS OS DADOS DA CONEXÃO PASSADAS POR PARAMETRO
		NO MOMENTO DA CRIAÇÃO DO OBJETO

		@param void 
		@return void
	*/
	public function __construct() 
	{
		parent::__construct();
	}

	/*
		FUNÇÃO PARA BUSCAR OS DADOS DOS PRODUTOS NO BANCO DADOS
		@param query string com select dos produtos
		@return bool - true em caso de sucesso ou false em caso de falha
	*/
	public function buscar ($query)
	{
		$this->load->database();// Cria conexao de banco de dados
		$busca = $this->db->simple_query($query.",".$this->limitSup);
		return $busca;
	}

	/*
		FUNÇÃO PARA BUSCAR OS DADOS DO PRODUTO NO BANCO DE DADOS
		@param string dado a busca do produto
		@return bool - true em caso de sucesso ou false em caso de falha
	*/
	public function buscarDetalhes ($query)
	{
		$this->load->database();// Cria conexao de banco de dados
		$busca = $this->db->simple_query($query);
		return $busca;
	}

	/*
		FUNÇÃO PARA SALVAR OS DADOS DO CLIENTE NO BANCO DADOS
		@param array() cliente - Vetor com os dados do cliente para inclusão no banco de dados
		@return bool - true em caso de sucesso ou false em caso de falha
	*/
	public function salvar ($dados)
	{
		$this->load->database();// Cria conexao de banco de dados
		$query = $this->db->insert_string($this->table, $dados);
		$insere = $this->db->simple_query($query);
		if ($insere)
			return $this->db->insert_id();
		else
			return false;
	}

	/*
		FUNÇÃO PARA EDITAR OS DADOS DO CLIENTE NO BANCO DADOS
		@param array() cliente - Vetor com os dados do cliente para inclusão no banco de dados
		@return bool - true em caso de sucesso ou false em caso de falha
	*/
	public function editar ($dados, $where)
	{
		$this->load->database();// Cria conexao de banco de dados

		$query = $this->db->update_string($this->table, $dados, $where);

		$insere = $this->db->simple_query($query);
		if ($insere)
			return true;
		else
			return false;
	}
}