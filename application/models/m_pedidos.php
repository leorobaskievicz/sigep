<?php
/*
	CLASSE CRIADO PARA ADMINISTRAR TODOS OS PEDIDOS DO SITE
	FORMATO CRUD PARA TABELA ADMPED1 E ADMPED2

	@authorLEONARDO ROBASKIEVICZ - 05/12/2015
	LEONARDO@TECWORKS.COM.BR

*/
class M_Pedidos extends CI_Model
{
	private $limitSup = 20;
	private $tablePed1 = "admped1";
	private $tablePed2 = "admped2";

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
		FUNÇÃO PARA SALVAR OS DADOS DO PEDIDO NO BANCO DE DADOS
		@param array() pedido - Vetor com os dados do cliente para inclusão no banco de dados
		@return bool - true em caso de sucesso ou false em caso de falha
	*/
	public function inserePedido ($dados)
	{
		$this->load->database();// Cria conexao de banco de dados
		$query = $this->db->insert_string($this->tablePed1, $dados);
		$insere = $this->db->simple_query($query);
		if ($insere)
			return $this->db->insert_id();
		else
			return false;
	}

	/*
		FUNÇÃO PARA SALVAR OS DADOS DOS ITENS PEDIDO NO BANCO DE DADOS
		@param array() pedido - Vetor com os dados do cliente para inclusão no banco de dados
		@return bool - true em caso de sucesso ou false em caso de falha
	*/
	public function insereItens ($dados)
	{
		$this->load->database();// Cria conexao de banco de dados
		$query = $this->db->insert_string($this->tablePed2, $dados);
		$insere = $this->db->simple_query($query);
		if ($insere)
			return $this->db->insert_id();
		else
			return false;
	}

}