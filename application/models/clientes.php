<?php
/*
	CLASSE CRIADO PARA ADMINISTRAR TODO O CADASTRO DE CLIENTES DO SITE
	FORMATO CRUD PARA TABELA ADMCAD1

	@authorLEONARDO ROBASKIEVICZ - 05/12/2015
	LEONARDO@TECWORKS.COM.BR

*/
class Clientes extends CI_Model
{
	private $table = "admcad1";

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
		FUNÇÃO PARA BUSCAR OS DADOS DO CLIENTE NO BANCO DADOS
		@param array() cliente - Vetor com os dados do cliente para inclusão no banco de dados
		@return bool - true em caso de sucesso ou false em caso de falha
	*/
	public function buscar ($query)
	{
		$this->load->database();// Cria conexao de banco de dados
		$busca = $this->db->simple_query($query);
		return $busca;
	}

	/*
		FUNÇÃO PARA BUSCAR OS DADOS DO CLIENTE NO BANCO DADOS PARA LOGIN NO SITE
		@param string e-mail, string senha
		@return bool - true em caso de sucesso ou false em caso de falha
	*/
	public function getLogin ($email = null, $senha = null)
	{
		$retorno = false;
		$codigo  = -1;
		$nome    = "Cliente não indentificado";
		if (($email != null) && ($senha != null)) {
			$this->load->database();// Cria conexao de banco de dados
			if ($busca = $this->db->simple_query("SELECT codigo,nome,senha FROM admcad1 WHERE email LIKE '".$email."'")) {
				if ($busca->rowCount() > 0) {
					$dados = $busca->fetch();
					if (password_verify($senha, $dados->senha)) {
						$retorno = true;
						$codigo = $dados->codigo;
						$nome = $dados->nome;
					}
				}
			}
		}
		return array($retorno, $codigo, $nome);
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