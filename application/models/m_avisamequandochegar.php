<?php
/*
	CLASSE CRIADO PARA ADMINISTRAR AVISOS DE PRODUTOS SEM ESTOQUES
	FORMATO CRUD PARA TABELA ADMCAD1

	@authorLEONARDO ROBASKIEVICZ - 05/12/2015
	LEONARDO@TECWORKS.COM.BR

*/
class M_Avisamequandochegar extends CI_Model
{
	private $table = "avisemequandochegar";

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
		FUNÇÃO PARA SALVAR OS DADOS DO AVISO DE PRODUTO SEM ESTOQUE
		@param array() cliente - Vetor com os dados do cliente para inclusão no banco de dados
		@return bool - true em caso de sucesso ou false em caso de falha
	*/
	public function salvar ($dados)
	{
		$this->load->database();// Cria conexao de banco de dados
		$query = $this->db->insert_string($this->table, $dados);
		$insere = $this->db->simple_query($query);
		if ($insere)
			return true;
		else
			return false;
	}

}